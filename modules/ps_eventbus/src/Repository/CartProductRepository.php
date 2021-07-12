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

class CartProductRepository
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
    public function getBaseQuery()
    {
        $query = new DbQuery();

        $query->from('cart_product', 'cp')
            ->where('cp.id_shop = ' . (int) $this->context->shop->id);

        return $query;
    }

    /**
     * @param array $cartIds
     *
     * @return array|bool|\mysqli_result|\PDOStatement|resource|null
     *
     * @throws \PrestaShopDatabaseException
     */
    public function getCartProducts(array $cartIds)
    {
        $query = $this->getBaseQuery();

        $query->select('cp.id_cart, cp.id_product, cp.id_product_attribute, cp.quantity, cp.date_add as created_at');

        if (!empty($cartIds)) {
            $query->where('cp.id_cart IN (' . implode(',', array_map('intval', $cartIds)) . ')');
        }

        return $this->db->executeS($query);
    }
}
