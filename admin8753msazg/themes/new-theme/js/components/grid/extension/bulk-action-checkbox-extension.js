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
 * Class BulkActionSelectCheckboxExtension
 */
export default class BulkActionCheckboxExtension {
  /**
   * Extend grid with bulk action checkboxes handling functionality
   *
   * @param {Grid} grid
   */
  extend(grid) {
    this._handleBulkActionCheckboxSelect(grid);
    this._handleBulkActionSelectAllCheckbox(grid);
  }

  /**
   * Handles "Select all" button in the grid
   *
   * @param {Grid} grid
   *
   * @private
   */
  _handleBulkActionSelectAllCheckbox(grid) {
    grid.getContainer().on('change', '.js-bulk-action-select-all', (e) => {
      const $checkbox = $(e.currentTarget);

      const isChecked = $checkbox.is(':checked');
      if (isChecked) {
        this._enableBulkActionsBtn(grid);
      } else {
        this._disableBulkActionsBtn(grid);
      }

      grid.getContainer().find('.js-bulk-action-checkbox').prop('checked', isChecked);
    });
  }

  /**
   * Handles each bulk action checkbox select in the grid
   *
   * @param {Grid} grid
   *
   * @private
   */
  _handleBulkActionCheckboxSelect(grid) {
    grid.getContainer().on('change', '.js-bulk-action-checkbox', () => {
      const checkedRowsCount = grid.getContainer().find('.js-bulk-action-checkbox:checked').length;

      if (checkedRowsCount > 0) {
        this._enableBulkActionsBtn(grid);
      } else {
        this._disableBulkActionsBtn(grid);
      }
    });
  }

  /**
   * Enable bulk actions button
   *
   * @param {Grid} grid
   *
   * @private
   */
  _enableBulkActionsBtn(grid) {
    grid.getContainer().find('.js-bulk-actions-btn').prop('disabled', false);
  }

  /**
   * Disable bulk actions button
   *
   * @param {Grid} grid
   *
   * @private
   */
  _disableBulkActionsBtn(grid) {
    grid.getContainer().find('.js-bulk-actions-btn').prop('disabled', true);
  }
}
