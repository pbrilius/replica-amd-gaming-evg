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

import createOrderPageMap from '@pages/order/create/create-order-map';
import Router from '@components/router';
import {EventEmitter} from '@components/event-emitter';
import eventMap from '@pages/order/create/event-map';

const $ = window.$;

/**
 * Provides ajax calls for getting cart information
 */
export default class CartProvider {
  constructor() {
    this.$container = $(createOrderPageMap.orderCreationContainer);
    this.router = new Router();
  }

  /**
   * Gets cart information
   *
   * @param cartId
   *
   * @returns {jqXHR}. Object with cart information in response.
   */
  getCart(cartId) {
    $.get(this.router.generate('admin_carts_info', {cartId})).then((cartInfo) => {
      EventEmitter.emit(eventMap.cartLoaded, cartInfo);
    });
  }

  /**
   * Gets existing empty cart or creates new empty cart for customer.
   *
   * @param customerId
   *
   * @returns {jqXHR}. Object with cart information in response
   */
  loadEmptyCart(customerId) {
    $.post(this.router.generate('admin_carts_create'), {
      customerId,
    }).then((cartInfo) => {
      EventEmitter.emit(eventMap.cartLoaded, cartInfo);
    });
  }

  /**
   * Duplicates cart from provided order
   *
   * @param orderId
   *
   * @returns {jqXHR}. Object with cart information in response
   */
  duplicateOrderCart(orderId) {
    $.post(this.router.generate('admin_orders_duplicate_cart', {orderId})).then((cartInfo) => {
      EventEmitter.emit(eventMap.cartLoaded, cartInfo);
    });
  }
}
