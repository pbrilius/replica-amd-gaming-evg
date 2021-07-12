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

import Grid from '@components/grid/grid';
import ReloadListActionExtension from '@components/grid/extension/reload-list-extension';
import ExportToSqlManagerExtension from '@components/grid/extension/export-to-sql-manager-extension';
import FiltersResetExtension from '@components/grid/extension/filters-reset-extension';
import SortingExtension from '@components/grid/extension/sorting-extension';
import LinkRowActionExtension from '@components/grid/extension/link-row-action-extension';
import BulkActionCheckboxExtension from '@components/grid/extension/bulk-action-checkbox-extension';
import SubmitRowActionExtension from '@components/grid/extension/action/row/submit-row-action-extension';
import FiltersSubmitButtonEnablerExtension
  from '@components/grid/extension/filters-submit-button-enabler-extension';
import SubmitBulkActionExtension from '@components/grid/extension/submit-bulk-action-extension';

const $ = window.$;

$(() => {
  const orderMessageGrid = new Grid('order_message');

  orderMessageGrid.addExtension(new ReloadListActionExtension());
  orderMessageGrid.addExtension(new ExportToSqlManagerExtension());
  orderMessageGrid.addExtension(new FiltersResetExtension());
  orderMessageGrid.addExtension(new SortingExtension());
  orderMessageGrid.addExtension(new LinkRowActionExtension());
  orderMessageGrid.addExtension(new SubmitBulkActionExtension());
  orderMessageGrid.addExtension(new BulkActionCheckboxExtension());
  orderMessageGrid.addExtension(new SubmitRowActionExtension());
  orderMessageGrid.addExtension(new FiltersSubmitButtonEnablerExtension());
});
