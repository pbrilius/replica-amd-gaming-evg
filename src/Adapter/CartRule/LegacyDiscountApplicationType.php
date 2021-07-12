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

namespace PrestaShop\PrestaShop\Adapter\CartRule;

/**
 * Legacy discount application types, used in cart rules, are defined in this class.
 */
final class LegacyDiscountApplicationType
{
    /**
     * Discount is applied for selected products
     */
    public const SELECTED_PRODUCTS = -2;

    /**
     * Discount is applied to cheapest product
     */
    public const CHEAPEST_PRODUCT = -1;

    /**
     * Discount is applied to order without shipping
     */
    public const ORDER_WITHOUT_SHIPPING = 0;

    /**
     * Class used only for constants.
     */
    private function __construct()
    {
    }
}
