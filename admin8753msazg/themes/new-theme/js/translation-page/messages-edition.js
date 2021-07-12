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

export default function (search) {
  $('.reset-translation-value').each((buttonIndex, button) => {
    let $editTranslationForm = $(button).parents('form');
    let defaultTranslationValue = $editTranslationForm.find('*[name=default]').val();

    $(button).click(() => {
      $editTranslationForm.find('*[name=translation_value]').val(defaultTranslationValue);
      $editTranslationForm.submit();
    });
  });

  let showFlashMessageOnEdit = (form) => {
    $(form).submit((event) => {
      event.preventDefault();

      let $editTranslationForm = $(event.target);
      let url = $editTranslationForm.attr('action');

      $.post(url, $editTranslationForm.serialize(), (response) => {
        let flashMessage;
        if (response['successful_update']) {
          flashMessage = $editTranslationForm.find('.alert-info');

          // Propagate edition
          let hash = $editTranslationForm.data('hash');
          let $editTranslationForms = $('[data-hash=' + hash + ']');
          let $translationValueFields = $($editTranslationForms.find('textarea'));
          $translationValueFields.val($editTranslationForm.find('textarea').val());

          // Refresh search index
          $editTranslationForms.removeAttr('data-jets');
          search.update();
        } else {
          flashMessage = $editTranslationForm.find('.alert-danger');
        }

        flashMessage.removeClass('hide');

        setTimeout(() => {
          flashMessage.addClass('hide');
        }, 4000);
      });

      return false;
    });
  };

  $('#jetsContent form, .translation-domain form').each((formIndex, form) => {
    showFlashMessageOnEdit(form);
  });
}
