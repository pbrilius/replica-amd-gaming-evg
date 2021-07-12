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

{* Generate HTML code for printing Invoice Icon with link *}
{if Configuration::get('PS_INVOICE')}
	<span style="width:20px; margin-right:5px;">
		<a href="{$link->getAdminLink('AdminPdf', true, [], ['submitAction' => 'generateInvoicePDF', 'id_order_invoice' => $id_invoice])|escape:'html':'UTF-8'}"><img src="../img/admin/tab-invoice.gif" alt="invoice" /></a>
	</span>
{/if}
