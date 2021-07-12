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

namespace PrestaShop\PrestaShop\Core\Domain\CmsPage\Command;

use PrestaShop\PrestaShop\Core\Domain\CmsPage\Exception\CmsPageException;
use PrestaShop\PrestaShop\Core\Domain\CmsPage\ValueObject\CmsPageId;

/**
 * Enables multiple cms pages.
 */
class BulkEnableCmsPageCommand
{
    /**
     * @var CmsPageId[]
     */
    private $cmsPages;

    /**
     * @param array $cmsPageIds
     *
     * @throws CmsPageException
     */
    public function __construct(array $cmsPageIds)
    {
        $this->setCmsPages($cmsPageIds);
    }

    /**
     * @return CmsPageId[]
     */
    public function getCmsPages()
    {
        return $this->cmsPages;
    }

    /**
     * @param array $cmsPageIds
     *
     * @throws CmsPageException
     */
    private function setCmsPages(array $cmsPageIds)
    {
        foreach ($cmsPageIds as $cmsPageId) {
            $this->cmsPages[] = new CmsPageId($cmsPageId);
        }
    }
}
