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

import Router from '@components/router';
import {EventEmitter} from '@components/event-emitter';
import eventMap from '@pages/order/create/event-map';
import createOrderMap from './create-order-map';

const $ = window.$;

/**
 * Provides ajax calls for cart editing actions
 * Each method emits an event with updated cart information after success.
 */
export default class CartEditor {
  constructor() {
    this.router = new Router();
  }

  /**
   * Changes cart addresses
   *
   * @param {Number} cartId
   * @param {Object} addresses
   */
  changeCartAddresses(cartId, addresses) {
    $.post(this.router.generate('admin_carts_edit_addresses', {cartId}), addresses)
      .then((cartInfo) => EventEmitter.emit(eventMap.cartAddressesChanged, cartInfo))
      .catch((response) => showErrorMessage(response.responseJSON.message));
  }

  /**
   * Modifies cart delivery option
   *
   * @param {Number} cartId
   * @param {Number} value
   */
  changeDeliveryOption(cartId, value) {
    $.post(this.router.generate('admin_carts_edit_carrier', {cartId}), {
      carrierId: value,
    })
      .then((cartInfo) => EventEmitter.emit(eventMap.cartDeliveryOptionChanged, cartInfo))
      .catch((response) => showErrorMessage(response.responseJSON.message));
  }

  /**
   * Changes cart free shipping value
   *
   * @param {Number} cartId
   */
  updateDeliveryOptions(cartId) {
    const freeShippingEnabled = $(createOrderMap.freeShippingSwitch)[1].checked;
    const isAGiftEnabled = $(createOrderMap.isAGiftSwitchValue).val() === '1';
    const useRecycledPackagingEnabled = $(createOrderMap.recycledPackagingSwitchValue).val() === '1';
    const giftMessage = $(createOrderMap.giftMessageField).val();

    $.post(this.router.generate('admin_carts_set_delivery_settings', {cartId}), {
      freeShipping: freeShippingEnabled,
      isAGift: isAGiftEnabled,
      useRecycledPackaging: useRecycledPackagingEnabled,
      giftMessage,
    })
      .then((cartInfo) => EventEmitter.emit(eventMap.cartDeliverySettingChanged, cartInfo))
      .catch((response) => showErrorMessage(response.responseJSON.message));
  }

  /**
   * Adds cart rule to cart
   *
   * @param {Number} cartRuleId
   * @param {Number} cartId
   */
  addCartRuleToCart(cartRuleId, cartId) {
    $.post(this.router.generate('admin_carts_add_cart_rule', {cartId}), {
      cartRuleId,
    })
      .then((cartInfo) => EventEmitter.emit(eventMap.cartRuleAdded, cartInfo))
      .catch((response) => EventEmitter.emit(eventMap.cartRuleFailedToAdd, response.responseJSON.message));
  }

  /**
   * Removes cart rule from cart
   *
   * @param {Number} cartRuleId
   * @param {Number} cartId
   */
  removeCartRuleFromCart(cartRuleId, cartId) {
    $.post(
      this.router.generate('admin_carts_delete_cart_rule', {
        cartId,
        cartRuleId,
      })
    )
      .then((cartInfo) => EventEmitter.emit(eventMap.cartRuleRemoved, cartInfo))
      .catch((response) => showErrorMessage(response.responseJSON.message));
  }

  /**
   * Adds product to cart
   *
   * @param {Number} cartId
   * @param {Object} data
   */
  addProduct(cartId, data) {
    let fileSizeHeader = '';
    if (!$.isEmptyObject(data.fileSizes)) {
      fileSizeHeader = JSON.stringify(data.fileSizes);
    }

    $.ajax(this.router.generate('admin_carts_add_product', {cartId}), {
      headers: {
        // Adds custom headers with submitted file sizes, to track if all files reached server side.
        'file-sizes': fileSizeHeader,
      },
      method: 'POST',
      data: data.product,
      processData: false,
      contentType: false,
    })
      .then((cartInfo) => EventEmitter.emit(eventMap.productAddedToCart, cartInfo))
      .catch((response) => EventEmitter.emit(eventMap.productAddToCartFailed, response.responseJSON.message));
  }

  /**
   * Removes product from cart
   *
   * @param {Number} cartId
   * @param {Object} product
   */
  removeProductFromCart(cartId, product) {
    $.post(this.router.generate('admin_carts_delete_product', {cartId}), {
      productId: product.productId,
      attributeId: product.attributeId,
      customizationId: product.customizationId,
    })
      .then((cartInfo) => EventEmitter.emit(eventMap.productRemovedFromCart, cartInfo))
      .catch((response) => showErrorMessage(response.responseJSON.message));
  }

  /**
   * Changes product price in cart
   *
   * @param {Number} cartId
   * @param {Number} customerId
   * @param {Object} product the updated product
   */
  changeProductPrice(cartId, customerId, product) {
    $.post(
      this.router.generate('admin_carts_edit_product_price', {
        cartId,
        productId: product.productId,
        productAttributeId: product.attributeId,
      }),
      {
        newPrice: product.price,
        customerId,
      }
    )
      .then((cartInfo) => EventEmitter.emit(eventMap.productPriceChanged, cartInfo))
      .catch((response) => showErrorMessage(response.responseJSON.message));
  }

  /**
   * Updates product quantity in cart
   *
   * @param cartId
   * @param product
   */
  changeProductQty(cartId, product) {
    $.post(
      this.router.generate('admin_carts_edit_product_quantity', {
        cartId,
        productId: product.productId,
      }),
      {
        newQty: product.newQty,
        attributeId: product.attributeId,
        customizationId: product.customizationId,
      }
    )
      .then((cartInfo) => EventEmitter.emit(eventMap.productQtyChanged, cartInfo))
      .catch((response) => EventEmitter.emit(eventMap.productQtyChangeFailed, response));
  }

  /**
   * Changes cart currency
   *
   * @param {Number} cartId
   * @param {Number} currencyId
   */
  changeCartCurrency(cartId, currencyId) {
    $(createOrderMap.cartCurrencySelect).data('selectedCurrencyId', currencyId);

    $.post(this.router.generate('admin_carts_edit_currency', {cartId}), {
      currencyId,
    })
      .then((cartInfo) => EventEmitter.emit(eventMap.cartCurrencyChanged, cartInfo))
      .catch((response) => EventEmitter.emit(eventMap.cartCurrencyChangeFailed, response));
  }

  /**
   * Changes cart language
   *
   * @param {Number} cartId
   * @param {Number} languageId
   */
  changeCartLanguage(cartId, languageId) {
    $.post(this.router.generate('admin_carts_edit_language', {cartId}), {
      languageId,
    })
      .then((cartInfo) => EventEmitter.emit(eventMap.cartLanguageChanged, cartInfo))
      .catch((response) => showErrorMessage(response.responseJSON.message));
  }
}
