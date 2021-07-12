{**
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
 *}

{extends file="helpers/options/options.tpl"}

{block name="after"}
<script type="text/javascript">
    function ajaxStoreStates(id_state_selected)
{
    $.ajax({
	url: "index.php",
	cache: false,
	data: "ajax=1&tab=AdminStates&token={getAdminToken tab='AdminStates'}&action=states&id_country="+$('#PS_SHOP_COUNTRY_ID').val() + "&id_state=" + $('#PS_SHOP_STATE_ID').val(),
	success: function(html)
	{
	    if (html == 'false')
	    {
		$("#conf_id_PS_SHOP_STATE_ID").parent().fadeOut();
		$('#PS_SHOP_STATE_ID option[value=0]').attr("selected", "selected");
	    }
	    else
	    {
		$("#PS_SHOP_STATE_ID").html(html);
		$("#conf_id_PS_SHOP_STATE_ID").parent().fadeIn();
		$('#PS_SHOP_STATE_ID option[value=' + id_state_selected + ']').attr("selected", "selected");
	    }
	}
    });
}

$(document).ready(function(){
    {if isset($categoryData.fields.PS_SHOP_STATE_ID.value)}
	    if ($('#PS_SHOP_COUNTRY_ID') && $('#PS_SHOP_STATE_ID'))
	    {
			ajaxStoreStates({$categoryData.fields.PS_SHOP_STATE_ID.value});
			$('#PS_SHOP_COUNTRY_ID').change(function() {
			    ajaxStoreStates();
			});
	    }
    {/if}
});
</script>
{/block}
