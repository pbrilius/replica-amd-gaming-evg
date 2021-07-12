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


namespace PrestaShop\Module\PsEventbus\Repository;

use Context;
use Db;
use DbQuery;
use mysqli_result;
use PDOStatement;
use PrestaShopDatabaseException;

class CartRepository
{
    /**
     * @var Db
     */
    private $db;
    /**
     * @var Context
     */
    private $context;

    public function __construct(Db $db, Context $context)
    {
        $this->db = $db;
        $this->context = $context;
    }

    /**
     * @return DbQuery
     */
    private function getBaseQuery()
    {
        $query = new DbQuery();

        $query->from('cart', 'c')
            ->where('c.id_shop = ' . (int) $this->context->shop->id);

        return $query;
    }

    /**
     * @param int $offset
     * @param int $limit
     *
     * @return array|bool|mysqli_result|PDOStatement|resource|null
     *
     * @throws PrestaShopDatabaseException
     */
    public function getCarts($offset, $limit)
    {
        $query = $this->getBaseQuery();

        $this->addSelectParameters($query);

        $query->limit($limit, $offset);

        return $this->db->executeS($query);
    }

    /**
     * @param int $offset
     *
     * @return int
     */
    public function getRemainingCartsCount($offset)
    {
        $query = $this->getBaseQuery();

        $query->select('(COUNT(c.id_cart) - ' . (int) $offset . ') as count');

        return (int) $this->db->getValue($query);
    }

    /**
     * @param int $limit
     * @param array $cartIds
     *
     * @return array
     *
     * @throws PrestaShopDatabaseException
     */
    public function getCartsIncremental($limit, $cartIds)
    {
        $query = $this->getBaseQuery();

        $this->addSelectParameters($query);

        $query->where('c.id_cart IN(' . implode(',', array_map('intval', $cartIds)) . ')')
            ->limit($limit);

        $result = $this->db->executeS($query);

        return is_array($result) ? $result : [];
    }

    /**
     * @param DbQuery $query
     *
     * @return void
     */
    private function addSelectParameters(DbQuery $query)
    {
        $query->select('c.id_cart, date_add as created_at, date_upd as updated_at');
    }
}
