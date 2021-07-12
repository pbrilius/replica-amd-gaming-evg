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

namespace PrestaShopBundle\Entity\Repository;

trait NormalizeFieldTrait
{
    /**
     * @param $rows
     *
     * @return mixed
     */
    protected function castNumericToInt($rows)
    {
        $castIdentifiersToIntegers = function (&$columnValue, $columnName) {
            if ($this->shouldCastToInt($columnName, $columnValue)) {
                $columnValue = (int) $columnValue;
            }
        };

        array_walk_recursive($rows, $castIdentifiersToIntegers);

        return $rows;
    }

    /**
     * @param $rows
     *
     * @return mixed
     */
    protected function castIdsToArray($rows)
    {
        $castIdentifiersToArray = function (&$columnValue, $columnName) {
            if ($this->shouldCastToInt($columnName, $columnValue)) {
                $columnValue = array_map('intval', explode(',', $columnValue));
            }
        };

        array_walk_recursive($rows, $castIdentifiersToArray);

        return $rows;
    }

    /**
     * @param string $columnName
     * @param string $columnValue
     *
     * @return bool
     */
    private function shouldCastToInt($columnName, $columnValue)
    {
        if (null === $columnValue || 'N/A' === $columnValue) {
            return false;
        }

        return preg_match('/_id|id_|_quantity|sign|active|total_|low_stock_/', $columnName);
    }
}
