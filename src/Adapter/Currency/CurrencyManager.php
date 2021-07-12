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

namespace PrestaShop\PrestaShop\Adapter\Currency;

use Currency;
use ObjectModel;
use Shop;

/**
 * Class CurrencyManager is responsible for dealing with currency data using legacy classes.
 */
class CurrencyManager
{
    /**
     * Updates currency data after default currency has changed.
     */
    public function updateDefaultCurrency()
    {
        /* Set conversion rate of default currency to 1 */
        ObjectModel::updateMultishopTable('Currency', ['conversion_rate' => 1], 'a.id_currency');

        $tmpContext = Shop::getContext();
        if ($tmpContext == Shop::CONTEXT_GROUP) {
            $tmpShop = Shop::getContextShopGroupID();
        } else {
            $tmpShop = (int) Shop::getContextShopID();
        }

        foreach (Shop::getContextListShopID() as $shopId) {
            Shop::setContext(Shop::CONTEXT_SHOP, (int) $shopId);
            Currency::refreshCurrencies();
        }

        Shop::setContext($tmpContext, $tmpShop);
    }
}
