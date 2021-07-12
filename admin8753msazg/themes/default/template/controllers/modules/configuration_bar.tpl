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

{$module_name = $module_name|escape:'html':'UTF-8'}
{capture}{'/&module_name='|cat:$module_name|cat:'/'}{/capture}
{if isset($display_multishop_checkbox) && $display_multishop_checkbox}
<div class="bootstrap panel">
	<h3><i class="icon-cogs"></i> {l s='Configuration' d='Admin.Global'}</h3>
	<input type="checkbox" name="activateModule" value="1"{if $module->isEnabledForShopContext()} checked="checked"{/if}
		onclick="location.href = '{$current_url|regex_replace:$smarty.capture.default:''}&amp;module_name={$module_name}&amp;enable=' + ($(this).prop('checked') ? '1' : '0');" />
	{l s='Activate module for this shop context: %s.' sprintf=[$shop_context] d='Admin.Modules.Notification'}
</div>
{/if}
