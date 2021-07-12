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

const $ = global.$;

/**
 * Class ReloadListExtension extends grid with "Column toggling" feature
 */
export default class ColumnTogglingExtension {

  /**
   * Extend grid
   *
   * @param {Grid} grid
   */
  extend(grid) {
    const $table = grid.getContainer().find('table.table');
    $table.find('.ps-togglable-row').on('click', (e) => {
      e.preventDefault();
      this._toggleValue($(e.delegateTarget));
    });
  }

  /**
   * @param {jQuery} row
   * @private
   */
  _toggleValue(row) {
    const toggleUrl = row.data('toggleUrl');

    this._submitAsForm(toggleUrl);
  }

  /**
   * Submits request url as form
   *
   * @param {string} toggleUrl
   * @private
   */
  _submitAsForm(toggleUrl) {
    const $form = $('<form>', {
      action: toggleUrl,
      method: 'POST',
    }).appendTo('body');

    $form.submit();
  }
}
