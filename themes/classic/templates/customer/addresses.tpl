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
{extends file='customer/page.tpl'}

{block name='page_title'}
  {l s='Your addresses' d='Shop.Theme.Customeraccount'}
{/block}

{block name='page_content'}
  {foreach $customer.addresses as $address}
    <div class="col-lg-4 col-md-6 col-sm-6">
    {block name='customer_address'}
      {include file='customer/_partials/block-address.tpl' address=$address}
    {/block}
    </div>
  {/foreach}
  <div class="clearfix"></div>
  <div class="addresses-footer">
    <a href="{$urls.pages.address}" data-link-action="add-address">
      <i class="material-icons">&#xE145;</i>
      <span>{l s='Create new address' d='Shop.Theme.Actions'}</span>
    </a>
  </div>
{/block}
