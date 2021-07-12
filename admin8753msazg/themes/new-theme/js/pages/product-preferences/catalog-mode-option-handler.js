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

class CatalogModeOptionHandler {
  constructor(pageMap) {
    this.pageMap = Object.assign({
      catalogModeField: 'input[name="form[general][catalog_mode]"]',
      selectedCatalogModeField: 'input[name="form[general][catalog_mode]"]:checked',
      catalogModeOptions: '.catalog-mode-option'
    }, pageMap);
    this.handle(0);

    $(this.pageMap.catalogModeField).on('change', () => this.handle(600));
  }

  handle(fadeLength) {
    const catalogModeVal = $(this.pageMap.selectedCatalogModeField).val();
    const catalogModeEnabled = parseInt(catalogModeVal);

    let catalogOptions = $(this.pageMap.catalogModeOptions);
    if (catalogModeEnabled) {
      catalogOptions.show(fadeLength);
    } else {
      catalogOptions.hide(fadeLength / 2);
    }
  }
}

export default CatalogModeOptionHandler;
