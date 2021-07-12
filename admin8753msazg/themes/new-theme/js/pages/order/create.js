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
import CreateOrderPage from './create/create-order-page';

const $ = window.$;
let orderPageManager = null;

/**
 * proxy to allow other scripts within the page to trigger the search
 * @param string
 */
function searchCustomerByString(string) {
  if (orderPageManager !== null) {
    orderPageManager.search(string);
  } else {
    console.log('Error: Could not search customer as orderPageManager is null');
  }
}

/**
 * proxy to allow other scripts within the page to refresh addresses list
 */
function refreshAddressesList(refreshCartAddresses) {
  if (orderPageManager !== null) {
    orderPageManager.refreshAddressesList(refreshCartAddresses);
  } else {
    console.log('Error: Could not refresh addresses list as orderPageManager is null');
  }
}

/**
 * proxy to allow other scripts within the Create Order page to refresh cart
 */
function refreshCart() {
  if (orderPageManager === null) {
    console.log('Error: Could not refresh addresses list as orderPageManager is null');
    return;
  }
  orderPageManager.refreshCart();
}


$(document).ready(() => {
  orderPageManager = new CreateOrderPage();
});

export {searchCustomerByString}
export {refreshAddressesList}
export {refreshCart}
