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
import SortingExtension from '@components/grid/extension/sorting-extension';
import FiltersResetExtension from '@components/grid/extension/filters-reset-extension';
import ReloadListActionExtension from '@components/grid/extension/reload-list-extension';
import ColumnTogglingExtension from '@components/grid/extension/column-toggling-extension';
import SubmitRowActionExtension from '@components/grid/extension/action/row/submit-row-action-extension';
import ExchangeRatesUpdateScheduler from '@pages/currency/ExchangeRatesUpdateScheduler';
import FiltersSubmitButtonEnablerExtension
  from '@components/grid/extension/filters-submit-button-enabler-extension';
import LinkRowActionExtension from '@components/grid/extension/link-row-action-extension';

const $ = window.$;

$(() => {
  const currency = new Grid('currency');
  currency.addExtension(new SortingExtension());
  currency.addExtension(new FiltersResetExtension());
  currency.addExtension(new ReloadListActionExtension());
  currency.addExtension(new ColumnTogglingExtension());
  currency.addExtension(new SubmitRowActionExtension());
  currency.addExtension(new FiltersSubmitButtonEnablerExtension());
  currency.addExtension(new LinkRowActionExtension());

  new ExchangeRatesUpdateScheduler();
});
