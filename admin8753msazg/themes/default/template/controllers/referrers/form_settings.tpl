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
<div class="row">
	<div class="col-lg-4">
			<form action="{$current|escape:'html':'UTF-8'}&amp;token={$token|escape:'html':'UTF-8'}" method="post" id="refresh_index_form" name="refresh_index_form" class="form-horizontal">
				<div class="panel">
					<h3>
						<i class="icon-fullscreen"></i> {l s='Indexing' d='Admin.Shopparameters.Feature'}
					</h3>
					<div class="alert alert-info">{l s='There is a huge quantity of data, so each connection corresponding to a referrer is indexed. You can also refresh this index by clicking the "%refresh_index_label%" button. This process may take a while, and it\'s only needed if you modified or added a referrer, or if you want changes to be retroactive.' d='Admin.Shopparameters.Help' sprintf=['%refresh_index_label%' => {l s='Refresh index' d='Admin.Shopparameters.Feature'}]}</div>
					<button type="submit" class="btn btn-default" name="submitRefreshIndex" id="submitRefreshIndex">
						<i class="icon-refresh"></i> {l s='Refresh index' d='Admin.Shopparameters.Feature'}
					</button>
				</div>
			</form>
		</div>
		<div class="col-lg-4">
			<form action="{$current|escape:'html':'UTF-8'}&amp;token={$token|escape:'html':'UTF-8'}" method="post" id="refresh_cache_form" name="refresh_cache_form" class="form-horizontal">
				<div class="panel">
					<h3>
						<i class="icon-briefcase"></i> {l s='Cache' d='Admin.Shopparameters.Feature'}
					</h3>
					<div class="alert alert-info">{l s='Your data is cached in order to sort it and filter it. You can refresh the cache by clicking on the "%refresh_cache_label%" button.' d='Admin.Shopparameters.Help' sprintf=['%refresh_cache_label%' => {l s='Refresh cache' d='Admin.Shopparameters.Feature'}]}</div>
					<button type="submit" class="btn btn-default" name="submitRefreshCache" id="submitRefreshCache">
						<i class="icon-refresh"></i> {l s='Refresh cache' d='Admin.Shopparameters.Feature'}
					</button>
				</div>
			</form>
		</div>
    <div class="col-lg-4">
      <form action="{$current|escape:'html':'UTF-8'}&amp;token={$token|escape:'html':'UTF-8'}" method="post" id="settings_form" name="settings_form" class="form-horizontal">
        <div class="panel">
          <h3>
            <i class="icon-cog"></i> {l s='Settings' d='Admin.Global'}
          </h3>
          <div class="alert alert-info">{l s='Direct traffic can be quite resource-intensive. You should consider enabling it only if you have a strong need for it.' d='Admin.Shopparameters.Help'}</div>
          <div class="form-group">
            <label class="control-label col-lg-6">{l s='Save direct traffic?' d='Admin.Shopparameters.Feature'}</label>
            <div class="col-lg-6">
              <div class="row">
                <div class="input-group fixed-width-md">
                  <span class="switch prestashop-switch">
                    <input type="radio" name="tracking_dt" id="tracking_dt_on" value="1" {if $tracking_dt}checked="checked"{/if} />
                    <label class="t" for="tracking_dt_on">
                      {l s='Yes' d='Admin.Global'}
                    </label>
                    <input type="radio" name="tracking_dt" id="tracking_dt_off" value="0" {if !$tracking_dt}checked="checked"{/if}  />
                    <label class="t" for="tracking_dt_off">
                      {l s='No' d='Admin.Global'}
                    </label>
                    <a class="slide-button btn"></a>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-6">{l s='Exclude taxes in sales total?' d='Admin.Shopparameters.Feature'}</label>
            <div class="col-lg-6">
              <div class="row">
                <div class="input-group fixed-width-md">
                  <span class="switch prestashop-switch">
                    <input type="radio" name="exclude_tx" id="exclude_tx_on" value="1" {if $exclude_tx}checked="checked"{/if} />
                    <label class="t" for="exclude_tx_on">
                      {l s='Yes' d='Admin.Global'}
                    </label>
                    <input type="radio" name="exclude_tx" id="exclude_tx_off" value="0" {if !$exclude_tx}checked="checked"{/if}  />
                    <label class="t" for="exclude_tx_off">
                      {l s='No' d='Admin.Global'}
                    </label>
                    <a class="slide-button btn"></a>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-6">{l s='Exclude shipping in sales total?' d='Admin.Shopparameters.Feature'}</label>
            <div class="col-lg-6">
              <div class="row">
                <div class="input-group fixed-width-md">
                  <span class="switch prestashop-switch">
                    <input type="radio" name="exclude_ship" id="exclude_ship_on" value="1" {if $exclude_ship}checked="checked"{/if} />
                    <label class="t" for="exclude_ship_on">
                      {l s='Yes' d='Admin.Global'}
                    </label>
                    <input type="radio" name="exclude_ship" id="exclude_ship_off" value="0" {if !$exclude_ship}checked="checked"{/if}  />
                    <label class="t" for="exclude_ship_off">
                      {l s='No' d='Admin.Global'}
                    </label>
                    <a class="slide-button btn"></a>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-default" name="submitSettings" id="submitSettings">
            <i class="icon-save"></i> {l s='Save' d='Admin.Actions'}
          </button>
        </div>
      </form>
    </div>
	</div>
</div>

<div id="settings_referrers" class="row">
	{if $statsdata_name}
		<div class="col-lg-3">
			<div class="panel">
				<div class="alert alert-info">
					{l s="The module '%s' must be activated and configurated in order to have all the statistics" sprintf=[$statsdata_name] d='Admin.Shopparameters.Notification'}
				</div>
			</div>
		</div>
	{/if}
</div>


