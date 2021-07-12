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

namespace PrestaShop\PrestaShop\Core\Domain\SqlManagement;

use PrestaShop\PrestaShop\Core\Domain\SqlManagement\Exception\SqlRequestException;

/**
 * Class DatabaseTablesList stores list of database tables.
 */
class DatabaseTablesList
{
    /**
     * @var string[]
     */
    private $dbTables;

    /**
     * @param string[] $dbTables
     *
     * @throws SqlRequestException
     */
    public function __construct(array $dbTables)
    {
        $this->setTables($dbTables);
    }

    /**
     * @return string[]
     */
    public function getTables()
    {
        return $this->dbTables;
    }

    /**
     * @param array $tables
     *
     * @return self
     *
     * @throws SqlRequestException
     */
    private function setTables(array $tables)
    {
        $filteredTables = array_filter($tables, 'is_string');

        if ($filteredTables !== $tables) {
            throw new SqlRequestException('Invalid database table list provided. Database tables list must contain string values only.');
        }

        $this->dbTables = $tables;

        return $this;
    }
}
