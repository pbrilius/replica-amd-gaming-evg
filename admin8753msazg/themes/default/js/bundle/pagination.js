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

$(document).ready(function() {

	/*
	 * Link action on the select list in the navigator toolbar. When change occurs, the page is refreshed (location.href redirection)
	 */
	$('select[name="paginator_select_page_limit"]').change(function() {
		var url = $(this).attr('psurl').replace(/_limit/, $('option:selected', this).val());
		window.location.href = url;
		return false;
	});

	/*
	 * Input field changes management
	 */
	function checkInputPage(eventOrigin) {
		var e = eventOrigin || event;
		var char = e.type === 'keypress' ? String.fromCharCode(e.keyCode || e.which) : (e.clipboardData || window.clipboardData).getData('Text');
		if (/[^\d]/gi.test(char)) {
			return false;
		}
	}
	$('input[name="paginator_jump_page"]').each(function() {
		this.onkeypress = checkInputPage;
		this.onpaste = checkInputPage;

		$(this).on('keyup', function(e) {
			var val = parseInt($(e.target).val());
			if (e.which === 13) { // ENTER
				e.preventDefault();
				if (parseInt(val) > 0) {
					var limit = $(e.target).attr('pslimit');
					var url = $(this).attr('psurl').replace(/999999/, (val-1)*limit);
					window.location.href = url;
					return false;
				}
			}
			var max = parseInt($(e.target).attr('psmax'));
			if (val > max) {
				$(this).val(max);
				return false;
			}
		});
		$(this).on('blur', function(e) {
			var val = parseInt($(e.target).val());
			if (parseInt(val) > 0) {
				var limit = $(e.target).attr('pslimit');
				var url = $(this).attr('psurl').replace(/999999/, (val-1)*limit);
				window.location.href = url;
				return false;
			}
		});
	});
});
