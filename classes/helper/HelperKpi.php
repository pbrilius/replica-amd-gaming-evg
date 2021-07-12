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
class HelperKpiCore extends Helper
{
    public $base_folder = 'helpers/kpi/';
    public $base_tpl = 'kpi.tpl';

    public $id;
    public $icon;
    public $chart;
    public $color;
    public $title;
    public $subtitle;
    public $value;
    public $data;
    public $source;
    public $refresh = true;
    public $href;
    public $tooltip;

    public function generate()
    {
        $this->tpl = $this->createTemplate($this->base_tpl);

        $this->tpl->assign([
            'id' => $this->id,
            'icon' => $this->icon,
            'chart' => (bool) $this->chart,
            'color' => $this->color,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'value' => $this->value,
            'data' => $this->data,
            'source' => $this->source,
            'refresh' => $this->refresh,
            'href' => $this->href,
            'tooltip' => $this->tooltip,
        ]);

        return $this->tpl->fetch();
    }
}
