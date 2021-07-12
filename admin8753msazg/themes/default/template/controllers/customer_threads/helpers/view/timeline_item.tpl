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
<article class="timeline-item{if isset($timeline_item.alt)} alt{/if}">
	<div class="timeline-caption">
		<div class="timeline-panel arrow arrow-{$timeline_item.arrow}">
			<span class="timeline-icon" style="background-color:{$timeline_item.background_color|escape:'html':'UTF-8'};">
				<i class="{$timeline_item.icon}"></i>
			</span>
			<span class="timeline-date"><i class="icon-calendar"></i> {dateFormat date=$timeline_item.date full=0} - <i class="icon-time"></i> {$timeline_item.date|substr:11:5}</span>
			{if isset($timeline_item.id_order)}<a class="badge" href="#">{l s="Order #" d='Admin.Orderscustomers.Feature'}{$timeline_item.id_order|intval}</a><br/>{/if}
			<span>{$timeline_item.content|nl2br}</span>
			{if isset($timeline_item.see_more_link)}
				<br/><br/><a href="{$timeline_item.see_more_link|escape:'html':'UTF-8'}" class="btn btn-default _blank">{l s="See more" d='Admin.Orderscustomers.Feature'}</a>
			{/if}
		</div>
	</div>
</article>
