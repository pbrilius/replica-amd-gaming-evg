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
import Jets from 'jets/jets';

export default function () {
  $(() => {
    const searchSelector = '.search-translation';
    $(searchSelector + ' form').submit(function (event) {
      event.preventDefault();

      $('#jetsContent form').addClass('hide');

      const keywords = $('#jetsSearch').val().toLowerCase();
      const jetsSelector = '#jetsContent > [data-jets*="' + keywords + '"]';

      if (0 === $(jetsSelector).length) {
        var notificationElement = $(searchSelector + '> .alert')[0];
        $(notificationElement).removeClass('hide');
        setTimeout(function () {
          $(notificationElement).addClass('hide');
        }, 2000);
      } else {
        $(jetsSelector).removeClass('hide');
      }

      if($(jetsSelector).length) {
        $('.js-results').show().addClass('card').find('h2').removeClass('hide');
      }

      return false;
    });

    $(searchSelector + ' input[type=reset]').click(function (event) {
      event.preventDefault();

      $('#jetsSearch').val('');
      $('#jetsContent form').addClass('hide');

      return false;
    });
  });

  if ($('#jetsSearch').length > 0) {
    return new Jets({
      searchTag: '#jetsSearch',
      contentTag: '#jetsContent',
      callSearchManually: true,
      manualContentHandling: function (tag) {
        // Search for translation keys and translation values
        return $(tag).find('.verbatim')[0].innerText + $(tag).find('textarea')[0].value;
      }
    });
  }
}
