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
{if isset($type)}
<form class="form-horizontal well" role="form">
    {if $type == 'badges_feature' || $type == 'badges_achievement'}
        <div class="form-group">
            <label>{l s='Type:' mod='gamification'}</label>
            <select id="group_select_{$type}" onchange="filterBadge('{$type}');">
                    <option value="badge_all">{l s='All' mod='gamification'}</option>
                {if isset($groups.$type)}
                {foreach from=$groups.$type key=id_group item=group}
                    <option value="group_{$id_group}">{$group}</option>
                {/foreach}
                {/if}
            </select>
        </div>
    {/if}
        <div class="form-group">
            <label>{l s='Status:' mod='gamification'}</label>
            <select id="status_select_{$type}" onchange="filterBadge('{$type}');">
                <option value="badge_all">{l s='All' mod='gamification'}</option>
                <option value="validated">{l s='Validated' mod='gamification'}</option>
                <option value="not_validated">{l s='Not Validated' mod='gamification'}</option>
            </select>
        </div>
    {if $type == 'badges_feature' || $type == 'badges_achievement'}
        <div class="form-group">
            <label>{l s='Level:' mod='gamification'}</label>
                <select id="level_select_{$type}" onchange="filterBadge('{$type}');">
                        <option value="badge_all">{l s='All' mod='gamification'}</option>
                    {if isset($levels)}
                    {foreach from=$levels key=id_level item=level}
                        <option value="level_{$id_level}">{$level}</option>
                    {/foreach}
                    {/if}
                </select>
        </div>
    {/if}
</form>
<div class="clear"></div>
{/if}
