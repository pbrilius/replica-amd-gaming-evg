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
final class ConversionRateKpi implements KpiInterface
{
    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $translator = Context::getContext()->getTranslator();

        $helper = new HelperKpi();
        $helper->id = 'box-conversion-rate';
        $helper->icon = 'assessment';
        $helper->color = 'color1';
        $helper->title = $translator->trans('Conversion Rate', [], 'Admin.Global');
        $helper->subtitle = $translator->trans('30 days', [], 'Admin.Global');

        if (ConfigurationKPI::get('CONVERSION_RATE') !== false) {
            $helper->value = ConfigurationKPI::get('CONVERSION_RATE');
        }

        if (ConfigurationKPI::get('CONVERSION_RATE_CHART') !== false) {
            $helper->data = ConfigurationKPI::get('CONVERSION_RATE_CHART');
        }

        $helper->source = Context::getContext()->link->getAdminLink('AdminStats')
            . '&ajax=1&action=getKpi&kpi=conversion_rate';
        $helper->refresh = (bool) (ConfigurationKPI::get('CONVERSION_RATE_EXPIRE') < time());

        return $helper->generate();
    }
}
