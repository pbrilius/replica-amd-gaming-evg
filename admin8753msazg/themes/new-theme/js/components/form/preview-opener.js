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

/**
 * Responsible for opening another page with specified url.
 * For example used in 'Save and preview' cms page create/edit actions.
 *
 * Usage: In selector element attr 'data-preview-url' provide page url.
 * The page will be opened once provided 'open_preview' parameter in query url
 */
export default class PreviewOpener {
  constructor (previewUrlSelector) {
    this.previewUrl = $(previewUrlSelector).data('preview-url');
    this._open();

    return {};
  }

  /**
   * Opens new page of provided url
   *
   * @private
   */
  _open() {
    const urlParams = new URLSearchParams(location.search);

    if (this.previewUrl && urlParams.has('open_preview')) {
      window.open(this.previewUrl, '_blank');
    }
  }
}
