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

namespace PrestaShop\PrestaShop\Adapter;

use Db;
use DbQuery;

/**
 * Adapter for Db legacy class.
 */
class Database implements \PrestaShop\PrestaShop\Core\Foundation\Database\DatabaseInterface
{
    /**
     * Perform a SELECT sql statement.
     *
     * @param string $sqlString
     *
     * @return array|false
     *
     * @throws \PrestaShopDatabaseException
     */
    public function select($sqlString)
    {
        return Db::getInstance()->executeS($sqlString);
    }

    /**
     * Escape $unsafe to be used into a SQL statement.
     *
     * @param string $unsafeData
     *
     * @return string
     */
    public function escape($unsafeData)
    {
        return Db::getInstance()->escape($unsafeData, true, true);
    }

    /**
     * Returns a value from the first row, first column of a SELECT query.
     *
     * @param string|DbQuery $sql
     * @param bool $useMaster
     * @param bool $useCache
     *
     * @return string|false|null
     */
    public function getValue($sql, $useMaster = true, $useCache = true)
    {
        return Db::getInstance($useMaster)->getValue($sql, $useCache);
    }

    /**
     * Returns the text of the error message from previous database operation.
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return Db::getInstance()->getMsgError();
    }

    /**
     * Enable the cache.
     */
    public function enableCache()
    {
        Db::getInstance()->enableCache();
    }

    /**
     * Disable the cache.
     */
    public function disableCache()
    {
        Db::getInstance()->disableCache();
    }
}
