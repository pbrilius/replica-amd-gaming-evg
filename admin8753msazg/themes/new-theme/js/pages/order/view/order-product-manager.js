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
import OrderViewEventMap from '@pages/order/view/order-view-event-map';

const $ = window.$;

export default class OrderProductManager {
  constructor() {
    this.router = new Router();
  }

  handleDeleteProductEvent(event) {
    event.preventDefault();

    const $btn = $(event.currentTarget);
    const confirmed = window.confirm($btn.data('deleteMessage'));
    if (!confirmed) {
      return;
    }

    $btn.pstooltip('dispose');
    $btn.prop('disabled', true);
    this.deleteProduct($btn.data('orderId'), $btn.data('orderDetailId'));
  }

  deleteProduct(orderId, orderDetailId) {
    $.ajax(this.router.generate('admin_orders_delete_product', {orderId, orderDetailId}), {
      method: 'POST',
    }).then(() => {
      EventEmitter.emit(OrderViewEventMap.productDeletedFromOrder, {
        oldOrderDetailId: orderDetailId,
        orderId,
      });
    }, (response) => {
      if (response.message) {
        $.growl.error({message: response.message});
      }
    });
  }
}
