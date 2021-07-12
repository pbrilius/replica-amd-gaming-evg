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

class ps_buybuttonliteRedirectManagerModuleFrontController extends ModuleFrontController
{
    const REDIRECT_TO_CART = 1;
    const REDIRECT_TO_CHECKOUT = 2;

    public function initContent()
    {
        parent::initContent();

        $idProduct = (int)Tools::getValue('id_product');
        $idProductAttribute = (int)Tools::getValue('id_product_attribute');
        $action = (int)Tools::getValue('action');

        $this->addProductToCart($idProduct, $idProductAttribute);

        switch ($action) {
            case self::REDIRECT_TO_CART:
                Tools::redirect('index.php?controller=cart&action=show');
                break;
            case self::REDIRECT_TO_CHECKOUT:
                Tools::redirect('index.php?controller=order');
                break;
            default:
                Tools::redirect('index.php?controller=cart&action=show');
                break;
        }
    }

    /**
     * Redirect to the checkout page with the product
     *
     * @param int $idProduct id of the product to add in the cart
     * @param int $idProductAttribute id of the product attribute if the product is a combination
     *
     * @return bool
     */
    public function addProductToCart($idProduct, $idProductAttribute = null)
    {
        if (Validate::isLoadedObject($this->context->cart)) {
            $this->context->cart->updateQty(1, $idProduct, $idProductAttribute);
        } else {
            $cart = new Cart();
            $cart->id_currency = $this->context->currency->id;
            $cart->id_lang = $this->context->language->id;
            $cart->save();

            $this->context->cart = $cart;
            $this->context->cart->updateQty(1, $idProduct, $idProductAttribute);
            $this->context->cookie->id_cart = $cart->id;
        }

        return true;
    }
}
