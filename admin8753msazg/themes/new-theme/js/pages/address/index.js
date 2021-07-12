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
import FiltersResetExtension from '@components/grid/extension/filters-reset-extension';
import SortingExtension from '@components/grid/extension/sorting-extension';
import ExportToSqlManagerExtension from '@components/grid/extension/export-to-sql-manager-extension';
import ReloadListExtension from '@components/grid/extension/reload-list-extension';
import BulkActionCheckboxExtension from '@components/grid/extension/bulk-action-checkbox-extension';
import SubmitBulkExtension from '@components/grid/extension/submit-bulk-action-extension';
import SubmitRowActionExtension from '@components/grid/extension/action/row/submit-row-action-extension';
import LinkRowActionExtension from '@components/grid/extension/link-row-action-extension';
import ChoiceTable from '@components/choice-table';

const $ = window.$;

$(() => {
  const addressGrid = new Grid('address');

  addressGrid.addExtension(new FiltersResetExtension());
  addressGrid.addExtension(new SortingExtension());
  addressGrid.addExtension(new ExportToSqlManagerExtension());
  addressGrid.addExtension(new ReloadListExtension());
  addressGrid.addExtension(new BulkActionCheckboxExtension());
  addressGrid.addExtension(new SubmitBulkExtension());
  addressGrid.addExtension(new SubmitRowActionExtension());
  addressGrid.addExtension(new LinkRowActionExtension());

  // needed for address required fields form
  new ChoiceTable();
});
