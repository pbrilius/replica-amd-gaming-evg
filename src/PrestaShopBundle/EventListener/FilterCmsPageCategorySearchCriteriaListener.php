<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

namespace PrestaShopBundle\EventListener;

use PrestaShop\PrestaShop\Core\Domain\CmsPageCategory\ValueObject\CmsPageCategoryId;
use PrestaShop\PrestaShop\Core\Search\Filters\CmsPageCategoryFilters;
use PrestaShop\PrestaShop\Core\Search\Filters\CmsPageFilters;
use PrestaShopBundle\Event\FilterSearchCriteriaEvent;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class FilterCmsPageCategorySearchCriteriaListener is responsible for updating CmsCategoryFilters filter with
 * cms page category id.
 */
class FilterCmsPageCategorySearchCriteriaListener
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param FilterSearchCriteriaEvent $event
     */
    public function onFilterSearchCriteria(FilterSearchCriteriaEvent $event)
    {
        $isAvailableFilter = $event->getSearchCriteria() instanceof CmsPageCategoryFilters ||
            $event->getSearchCriteria() instanceof CmsPageFilters
        ;

        if (!$isAvailableFilter) {
            return;
        }

        $searchCriteriaClass = get_class($event->getSearchCriteria());

        $searchCriteria = $event->getSearchCriteria();

        $filters = $searchCriteria->getFilters();

        $request = $this->requestStack->getCurrentRequest();

        if (null !== $request) {
            $cmsCategoryId = $this->requestStack->getCurrentRequest()->query->getInt('id_cms_category');

            if (!$cmsCategoryId) {
                $cmsCategoryId = CmsPageCategoryId::ROOT_CMS_PAGE_CATEGORY_ID;
            }

            $filters['id_cms_category_parent'] = $cmsCategoryId;
        }

        $newSearchCriteria = new $searchCriteriaClass([
            'orderBy' => $searchCriteria->getOrderBy(),
            'sortOrder' => $searchCriteria->getOrderWay(),
            'offset' => $searchCriteria->getOffset(),
            'limit' => $searchCriteria->getLimit(),
            'filters' => $filters,
        ]);

        $event->setSearchCriteria($newSearchCriteria);
    }
}
