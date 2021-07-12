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
import productHeader from './product-header';
import productSearchAutocomplete from './product-search-autocomplete';
import categoryTree from './category-tree';
import attributes from './attributes';
import bulkCombination from './product-bulk-combinations';
import nestedCategory from './nested-categories';
import combination from './combination';
import Serp from '../app/utils/serp/index';

const $ = window.$;

$(() => {
  productHeader();
  productSearchAutocomplete();
  categoryTree();
  attributes();
  combination();
  bulkCombination().init();
  nestedCategory().init();

  new Serp(
    {
      container: '#serp-app',
      defaultTitle: '.serp-default-title:input',
      watchedTitle: '.serp-watched-title:input',
      defaultDescription: '.serp-default-description',
      watchedDescription: '.serp-watched-description',
      watchedMetaUrl: '.serp-watched-url:input',
    },
    $('#product_form_preview_btn').data('seo-url')
  );

  // This is the only script for the module page so there is no specific file for it.
  $('.modules-list-select').on('change', (e) => {
    $('.module-render-container').hide();
    $(`.${e.target.value}`).show();
  });

  $('.modules-list-button').on('click', (e) => {
    const target = $(e.target).data('target');
    $('.module-selection').show();
    $('.modules-list-select').val(target).trigger('change');
    return false;
  });
});
