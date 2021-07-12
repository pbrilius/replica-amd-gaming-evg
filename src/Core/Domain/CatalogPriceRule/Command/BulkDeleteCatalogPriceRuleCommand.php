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

namespace PrestaShop\PrestaShop\Core\Domain\CatalogPriceRule\Command;

use PrestaShop\PrestaShop\Core\Domain\CatalogPriceRule\Exception\CatalogPriceRuleConstraintException;
use PrestaShop\PrestaShop\Core\Domain\CatalogPriceRule\ValueObject\CatalogPriceRuleId;

/**
 * Deletes catalog price rules in bulk acton
 */
class BulkDeleteCatalogPriceRuleCommand
{
    /**
     * @var CatalogPriceRuleId[]
     */
    private $catalogPriceRuleIds;

    /**
     * @param int[] $catalogPriceRuleIds
     *
     * @throws CatalogPriceRuleConstraintException
     */
    public function __construct(array $catalogPriceRuleIds)
    {
        $this->setCatalogPriceRuleIds($catalogPriceRuleIds);
    }

    /**
     * @return CatalogPriceRuleId[]
     */
    public function getCatalogPriceRuleIds()
    {
        return $this->catalogPriceRuleIds;
    }

    /**
     * @param int[] $catalogPriceRuleIds
     *
     * @throws CatalogPriceRuleConstraintException
     */
    private function setCatalogPriceRuleIds(array $catalogPriceRuleIds)
    {
        foreach ($catalogPriceRuleIds as $catalogPriceRuleId) {
            $this->catalogPriceRuleIds[] = new CatalogPriceRuleId($catalogPriceRuleId);
        }
    }
}
