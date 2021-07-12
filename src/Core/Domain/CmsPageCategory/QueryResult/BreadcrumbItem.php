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

namespace PrestaShop\PrestaShop\Core\Domain\CmsPageCategory\QueryResult;

use PrestaShop\PrestaShop\Core\Domain\CmsPageCategory\Exception\CmsPageCategoryException;
use PrestaShop\PrestaShop\Core\Domain\CmsPageCategory\ValueObject\CmsPageCategoryId;

/**
 * Class CmsPageCategory is responsible for providing cms page id and name combination.
 */
class BreadcrumbItem
{
    /**
     * @var CmsPageCategoryId
     */
    private $cmsPageCategoryId;

    /**
     * @var string
     */
    private $name;

    /**
     * @param int $cmsPageCategoryId
     * @param string $name
     *
     * @throws CmsPageCategoryException
     */
    public function __construct($cmsPageCategoryId, $name)
    {
        $this->cmsPageCategoryId = new CmsPageCategoryId($cmsPageCategoryId);
        $this->name = $name;
    }

    /**
     * @return CmsPageCategoryId
     */
    public function getCmsPageCategoryId()
    {
        return $this->cmsPageCategoryId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
