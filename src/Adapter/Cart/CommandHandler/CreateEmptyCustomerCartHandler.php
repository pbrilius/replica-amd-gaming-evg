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

namespace PrestaShop\PrestaShop\Adapter\Cart\CommandHandler;

use Cart;
use Configuration;
use Customer;
use PrestaShop\PrestaShop\Core\Domain\Cart\Command\CreateEmptyCustomerCartCommand;
use PrestaShop\PrestaShop\Core\Domain\Cart\CommandHandler\CreateEmptyCustomerCartHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Cart\ValueObject\CartId;
use PrestaShopException;

/**
 * @internal
 */
final class CreateEmptyCustomerCartHandler implements CreateEmptyCustomerCartHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(CreateEmptyCustomerCartCommand $command)
    {
        $customer = new Customer($command->getCustomerId()->getValue());

        $lastEmptyCartId = $customer->getLastEmptyCart(false);

        if ($lastEmptyCartId) {
            $cart = new Cart($lastEmptyCartId);
        } else {
            $cart = $this->createEmptyCustomerCart($customer);
        }

        return new CartId((int) $cart->id);
    }

    /**
     * @param Customer $customer
     *
     * @return Cart
     *
     * @throws PrestaShopException
     */
    private function createEmptyCustomerCart(Customer $customer): Cart
    {
        $cart = new Cart();

        $cart->recyclable = 0;
        $cart->gift = 0;
        $cart->id_customer = $customer->id;
        $cart->secure_key = $customer->secure_key;

        $cart->id_shop = $customer->id_shop;
        $cart->id_lang = (int) Configuration::get('PS_LANG_DEFAULT');
        $cart->id_currency = (int) Configuration::get('PS_CURRENCY_DEFAULT');

        $addresses = $customer->getAddresses($cart->id_lang);
        $addressId = !empty($addresses) ? (int) reset($addresses)['id_address'] : null;
        $cart->id_address_delivery = $addressId;
        $cart->id_address_invoice = $addressId;

        $cart->setNoMultishipping();
        $cart->save();

        return $cart;
    }
}
