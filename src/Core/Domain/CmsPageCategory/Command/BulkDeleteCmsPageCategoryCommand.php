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

namespace PrestaShop\PrestaShop\Core\Domain\CmsPageCategory\Command;

use PrestaShop\PrestaShop\Core\Domain\CmsPageCategory\Exception\CmsPageCategoryConstraintException;
use PrestaShop\PrestaShop\Core\Domain\CmsPageCategory\Exception\CmsPageCategoryException;
use PrestaShop\PrestaShop\Core\Domain\CmsPageCategory\ValueObject\CmsPageCategoryId;

/**
 * Class BulkDeleteCmsPageCategoryCommand is responsible for deleting multiple cms page categories.
 */
class BulkDeleteCmsPageCategoryCommand extends AbstractBulkCmsPageCategoryCommand
{
    /**
     * @var CmsPageCategoryId[]
     */
    private $cmsPageCategoryIds;

    /**
     * @param int[] $cmsPageCategoryIds
     *
     * @throws CmsPageCategoryException
     */
    public function __construct(array $cmsPageCategoryIds)
    {
        if ($this->assertIsEmptyOrContainsNonIntegerValues($cmsPageCategoryIds)) {
            throw new CmsPageCategoryConstraintException(sprintf('Missing cms page category data or array %s contains non integer values for bulk deleting', var_export($cmsPageCategoryIds, true)), CmsPageCategoryConstraintException::INVALID_BULK_DATA);
        }

        $this->setCmsPageCategoryIds($cmsPageCategoryIds);
    }

    /**
     * @return CmsPageCategoryId[]
     */
    public function getCmsPageCategoryIds()
    {
        return $this->cmsPageCategoryIds;
    }

    /**
     * @param int[] $cmsPageCategoryIds
     *
     * @throws CmsPageCategoryException
     */
    private function setCmsPageCategoryIds(array $cmsPageCategoryIds)
    {
        foreach ($cmsPageCategoryIds as $id) {
            $this->cmsPageCategoryIds[] = new CmsPageCategoryId($id);
        }
    }
}
