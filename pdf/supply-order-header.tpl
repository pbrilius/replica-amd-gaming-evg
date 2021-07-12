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
<table>
	<tr><td style="line-height: 6px">&nbsp;</td></tr>
</table>

<table style="width: 100%">
<tr>
	<td style="width: 50%">
		{if $logo_path}
			<img src="{$logo_path}" />
		{/if}
	</td>
	<td style="width: 50%; text-align: right;">
		<table style="width: 100%">
			<tr>
				<td style="font-weight: bold; font-size: 13pt; color: #444; width: 100%">{$shop_name|escape:'html':'UTF-8'}</td>
			</tr>
			<tr>
				<td style="font-size: 13pt; color: #444; font-weight: bold;">{$date|escape:'html':'UTF-8'}</td>
			</tr>
			<tr>
				<td style="font-size: 13pt; color: #444; font-weight: bold;">{$title|escape:'html':'UTF-8'}</td>
			</tr>
			<tr>
				<td style="font-size: 13pt; color: #444; font-weight: bold;">{$reference|escape:'html':'UTF-8'}</td>
			</tr>
		</table>
	</td>
</tr>
</table>

