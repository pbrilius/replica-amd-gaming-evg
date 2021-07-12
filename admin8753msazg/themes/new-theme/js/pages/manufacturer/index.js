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

import TranslatableInput from '@components/translatable-input';
import TaggableField from '@components/taggable-field';
import FormSubmitButton from '@components/form-submit-button';
import Grid from '@components/grid/grid';
import SortingExtension from '@components/grid/extension/sorting-extension';
import FiltersResetExtension from '@components/grid/extension/filters-reset-extension';
import ReloadListActionExtension from '@components/grid/extension/reload-list-extension';
import ColumnTogglingExtension from '@components/grid/extension/column-toggling-extension';
import SubmitRowActionExtension from '@components/grid/extension/action/row/submit-row-action-extension';
import SubmitBulkExtension from '@components/grid/extension/submit-bulk-action-extension';
import BulkActionCheckboxExtension from '@components/grid/extension/bulk-action-checkbox-extension';
import ExportToSqlManagerExtension from '@components/grid/extension/export-to-sql-manager-extension';
import FiltersSubmitButtonEnablerExtension
  from '@components/grid/extension/filters-submit-button-enabler-extension';
import ChoiceTree from '@components/form/choice-tree';
import TranslatableField from '@components/translatable-field';
import TinyMCEEditor from '@components/tinymce-editor';
import LinkRowActionExtension from '@components/grid/extension/link-row-action-extension';

const $ = window.$;

$(() => {
  ['manufacturer', 'manufacturer_address'].forEach((gridName) => {
    const grid = new Grid(gridName);
    grid.addExtension(new ExportToSqlManagerExtension());
    grid.addExtension(new ReloadListActionExtension());
    grid.addExtension(new SortingExtension());
    grid.addExtension(new FiltersResetExtension());
    grid.addExtension(new ColumnTogglingExtension());
    grid.addExtension(new SubmitRowActionExtension());
    grid.addExtension(new SubmitBulkExtension());
    grid.addExtension(new BulkActionCheckboxExtension());
    grid.addExtension(new FiltersSubmitButtonEnablerExtension());
    grid.addExtension(new LinkRowActionExtension());
  });

  new TranslatableInput();
  new TranslatableField();
  new TinyMCEEditor();
  new TaggableField({
    tokenFieldSelector: 'input.js-taggable-field',
    options: {
      createTokensOnBlur: true,
    },
  });

  new FormSubmitButton();
  new ChoiceTree('#manufacturer_shop_association').enableAutoCheckChildren();
});
