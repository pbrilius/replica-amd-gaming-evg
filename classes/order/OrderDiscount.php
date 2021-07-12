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

/**
 * @deprecated 1.5.0
 */
class OrderDiscountCore extends OrderCartRule
{
    public function __get($key)
    {
        Tools::displayAsDeprecated();
        if ($key == 'id_order_discount') {
            return $this->id_order_cart_rule;
        }
        if ($key == 'id_discount') {
            return $this->id_cart_rule;
        }

        return $this->{$key};
    }

    public function __set($key, $value)
    {
        Tools::displayAsDeprecated();
        if ($key == 'id_order_discount') {
            $this->id_order_cart_rule = $value;
        }
        if ($key == 'id_discount') {
            $this->id_cart_rule = $value;
        }
        $this->{$key} = $value;
    }

    public function __call($method, $args)
    {
        Tools::displayAsDeprecated();

        return call_user_func_array([$this->parent, $method], $args);
    }
}
