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
class LinkProxyCore
{
    private $link;

    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    public function getPageLink($controller, $ssl = null, $id_lang = null, $request = null, $request_url_encode = false, $id_shop = null, $relative_protocol = false)
    {
        return $this->link->getPageLink($controller, $ssl, $id_lang, $request, $request_url_encode, $id_shop, $relative_protocol);
    }

    public function getProductLink($product, $alias = null, $category = null, $ean13 = null, $id_lang = null, $id_shop = null, $ipa = 0, $force_routes = false, $relative_protocol = false, $add_anchor = false, $extra_params = [])
    {
        return $this->link->getProductLink($product, $alias, $category, $ean13, $id_lang, $id_shop, $ipa, $force_routes, $relative_protocol, $add_anchor, $extra_params);
    }
}
