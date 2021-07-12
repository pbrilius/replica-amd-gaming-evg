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

namespace PrestaShop\PrestaShop\Core\Domain\CmsPage\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\CmsPage\Exception\CmsPageException;

/**
 * Class which holds the cms page id value.
 */
class CmsPageId
{
    /**
     * @var int
     */
    private $cmsPageId;

    /**
     * @param int $cmsPageId
     *
     * @throws CmsPageException
     */
    public function __construct($cmsPageId)
    {
        $this->assertIsIntegerGreaterThanZero($cmsPageId);
        $this->cmsPageId = $cmsPageId;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->cmsPageId;
    }

    /**
     * Validates that the value is integer and is greater than zero.
     *
     * @param int $cmsPageId
     *
     * @throws CmsPageException
     */
    private function assertIsIntegerGreaterThanZero($cmsPageId)
    {
        if (!is_int($cmsPageId) || 0 >= $cmsPageId) {
            throw new CmsPageException(sprintf('Invalid cms page id %s supplied', var_export($cmsPageId, true)));
        }
    }
}
