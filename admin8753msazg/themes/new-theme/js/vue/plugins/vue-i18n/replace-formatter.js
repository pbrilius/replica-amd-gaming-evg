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

/**
 * This formatter is used by VueI18n, the basic format for variables looks
 * like 'Hi {name}' or 'Hi {0}' Sadly it doesn't match the PrestaShop usual
 * placeholders format.
 * So this custom formatter allows us to simple replace in order to use formats
 * like 'Hi %name%' the parameters then should be an object like {'%name%': 'John'}
 */
export default class ReplaceFormatter {
  /**
   * @param message {string}
   * @param values {object}
   *
   * @returns {array}
   */
  interpolate (message, values) {
    for (let param in values) {
      message = message.replace(param, values[param]);
    }

    return [message];
  }
}
