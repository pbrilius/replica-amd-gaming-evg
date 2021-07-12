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

namespace PrestaShop\PrestaShop\Adapter\Import;

use Doctrine\DBAL\Connection;

/**
 * Class DataMatchSaver saves data configuration match.
 * This class will be removed with CQRS introduction.
 */
final class DataMatchSaver
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var string
     */
    private $dbPrefix;

    /**
     * @param Connection $connection
     * @param string $dbPrefix
     */
    public function __construct(Connection $connection, $dbPrefix)
    {
        $this->connection = $connection;
        $this->dbPrefix = $dbPrefix;
    }

    /**
     * Save data match.
     *
     * @param string $name name of the match
     * @param array $value value of the match
     * @param int $skipRows number of rows to skip from the import file
     *
     * @return bool
     */
    public function save($name, array $value, $skipRows)
    {
        return (bool) $this->connection->insert(
            $this->dbPrefix . 'import_match',
            [
                '`name`' => pSQL($name),
                '`match`' => pSQL(implode('|', $value)),
                '`skip`' => (int) $skipRows,
            ]
        );
    }
}
