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
 * Class SubmitGridActionExtension handles grid action submits
 */
export default class SubmitGridActionExtension {
  constructor() {
    return {
      extend: (grid) => this.extend(grid)
    };
  }

  extend(grid) {
    grid.getHeaderContainer().on('click', '.js-grid-action-submit-btn', (event) => {
      this.handleSubmit(event, grid);
    });
  }

  /**
   * Handle grid action submit.
   * It uses grid form to submit actions.
   *
   * @param {Event} event
   * @param {Grid} grid
   *
   * @private
   */
  handleSubmit(event, grid) {
    const $submitBtn = $(event.currentTarget);
    const confirmMessage = $submitBtn.data('confirm-message');

    if (typeof confirmMessage !== "undefined" && 0 < confirmMessage.length && !confirm(confirmMessage)) {
        return;
    }

    const $form = $('#' + grid.getId() + '_filter_form');

    $form.attr('action', $submitBtn.data('url'));
    $form.attr('method', $submitBtn.data('method'));
    $form.find('input[name="' + grid.getId() + '[_token]"]').val($submitBtn.data('csrf'));
    $form.submit();
  }
}
