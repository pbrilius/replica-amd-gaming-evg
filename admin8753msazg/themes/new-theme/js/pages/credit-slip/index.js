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

import Grid from '../../components/grid/grid';
import SortingExtension from '../../components/grid/extension/sorting-extension';
import FiltersResetExtension from '../../components/grid/extension/filters-reset-extension';
import ReloadListActionExtension from '../../components/grid/extension/reload-list-extension';
import ExportToSqlManagerExtension from '../../components/grid/extension/export-to-sql-manager-extension';
import TranslatableInput from '../../components/translatable-input';
import FiltersSubmitButtonEnablerExtension
  from '../../components/grid/extension/filters-submit-button-enabler-extension';

const $ = window.$;

$(() => {
  const creditSlipGrid = new Grid('credit_slip');

  creditSlipGrid.addExtension(new ExportToSqlManagerExtension());
  creditSlipGrid.addExtension(new ReloadListActionExtension());
  creditSlipGrid.addExtension(new SortingExtension());
  creditSlipGrid.addExtension(new FiltersResetExtension());
  creditSlipGrid.addExtension(new FiltersSubmitButtonEnablerExtension());

  new TranslatableInput();
});
