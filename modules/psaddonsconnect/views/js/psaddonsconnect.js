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

$(document).ready(function(){
    $("#ps-addons-connect-form").submit(function(event) {
    event.preventDefault();
    event.stopPropagation();
    $.ajax({
        method: 'POST',
        url: $(this).attr('action'),
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function() {
          $("button.btn[type='submit']", "#ps-addons-connect-form").hide();
        }
    }).done(function (response) {
        var ps_responseCode = response.success;
        var ps_responseMsg = response.message;
        //Replace special characters
        ps_responseMsg = ps_responseMsg.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g,' ');

        if (ps_responseCode === 1) {
          location.reload();
        } else {
          $.growl.error({message: ps_responseMsg});
          $("button.btn[type='submit']", "#ps-addons-connect-form").fadeIn();
        }
      });
    });
});

//Show 1.6 modal
function psGetModal() {
  $(".addons_connect").click();
}
