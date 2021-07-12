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

namespace PrestaShop\PrestaShop\Core\Localization;

/**
 * Locale entity interface.
 *
 * Describes the behavior of locale classes
 */
interface LocaleInterface
{
    /**
     * Format a number according to locale rules.
     *
     * @param int|float|string $number The number to be formatted
     *
     * @return string The formatted number
     */
    public function formatNumber($number);

    /**
     * Format a number as a price.
     *
     * @param int|float|string $number Number to be formatted as a price
     * @param string $currencyCode Currency of the price
     *
     * @return string The formatted price
     */
    public function formatPrice($number, $currencyCode);
}
