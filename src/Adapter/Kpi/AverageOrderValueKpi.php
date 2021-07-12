<?php
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

namespace PrestaShop\PrestaShop\Adapter\Kpi;

use ConfigurationKPI;
use Context;
use HelperKpi;
use PrestaShop\PrestaShop\Core\Kpi\KpiInterface;

/**
 * @internal
 */
final class AverageOrderValueKpi implements KpiInterface
{
    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $translator = Context::getContext()->getTranslator();

        $helper = new HelperKpi();
        $helper->id = 'box-average-order';
        $helper->icon = 'account_balance_wallet';
        $helper->color = 'color1';
        $helper->title = $translator->trans('Average Order Value', [], 'Admin.Global');
        $helper->subtitle = $translator->trans('30 days', [], 'Admin.Global');

        if (ConfigurationKPI::get('AVG_ORDER_VALUE') !== false) {
            $helper->value = $translator->trans(
                '%amount% tax excl.',
                ['%amount%' => ConfigurationKPI::get('AVG_ORDER_VALUE')],
                'Admin.Orderscustomers.Feature'
            );
        }

        $helper->source = Context::getContext()->link->getAdminLink('AdminStats')
            . '&ajax=1&action=getKpi&kpi=average_order_value';
        $helper->refresh = (bool) (ConfigurationKPI::get('AVG_ORDER_VALUE_EXPIRE') < time());

        return $helper->generate();
    }
}
