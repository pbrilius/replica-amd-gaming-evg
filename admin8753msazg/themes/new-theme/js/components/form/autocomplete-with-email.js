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

const $ = window.$;

export default class AutocompleteWithEmail {
  constructor(emailInputSelector, map = []) {
    this.map = map;
    this.$emailInput = $(emailInputSelector);
    this.$emailInput.on('change', () => this.change());
  }

  change() {
    $.get({
      url: this.$emailInput.data('customer-information-url'),
      dataType: 'json',
      data: {
        email: this.$emailInput.val(),
      },
    }).then((response) => {
      Object.keys(this.map).forEach((key) => {
        if (response[key] !== undefined) {
          $(this.map[key]).val(response[key]);
        }
      });
    }).catch((response) => {
      if (typeof response.responseJSON !== 'undefined') {
        showErrorMessage(response.responseJSON.message);
      }
    });
  }
}
