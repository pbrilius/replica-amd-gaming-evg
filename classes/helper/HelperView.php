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
class HelperViewCore extends Helper
{
    public $id;
    public $toolbar = true;
    public $table;
    public $token;

    /** @var string|null If not null, a title will be added on that list */
    public $title = null;

    public function __construct()
    {
        $this->base_folder = 'helpers/view/';
        $this->base_tpl = 'view.tpl';
        parent::__construct();
    }

    public function generateView()
    {
        $this->tpl = $this->createTemplate($this->base_tpl);

        $this->tpl->assign([
            'title' => $this->title,
            'current' => $this->currentIndex,
            'token' => $this->token,
            'table' => $this->table,
            'show_toolbar' => $this->show_toolbar,
            'toolbar_scroll' => $this->toolbar_scroll,
            'toolbar_btn' => $this->toolbar_btn,
            'link' => $this->context->link,
        ]);

        return parent::generate();
    }
}
