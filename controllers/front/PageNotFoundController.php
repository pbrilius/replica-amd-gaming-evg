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
class PageNotFoundControllerCore extends FrontController
{
    public $php_self = 'pagenotfound';
    public $page_name = 'pagenotfound';
    public $ssl = true;

    /**
     * Assign template vars related to page content.
     *
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        $this->context->cookie->disallowWriting();
        parent::initContent();
        $this->setTemplate('errors/404');
    }

    protected function canonicalRedirection($canonical_url = '')
    {
        // 404 - no need to redirect to the canonical url
    }

    protected function sslRedirection()
    {
        // 404 - no need to redirect
    }

    public function getTemplateVarPage()
    {
        $page = parent::getTemplateVarPage();
        $page['title'] = $this->trans('The page you are looking for was not found.', [], 'Shop.Theme.Global');

        return $page;
    }
}
