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

namespace PrestaShop\PrestaShop\Adapter\Pack;

use Context;
use Pack;
use Product;

/**
 * This class will provide data from DB / ORM about product pack.
 */
class PackDataProvider
{
    /**
     * Get product pack items.
     *
     * @param int $id_product
     * @param int $id_lang
     */
    public function getItems($id_product, $id_lang)
    {
        $packItems = Pack::getItems($id_product, $id_lang);

        foreach ($packItems as $packItem) {
            $cover = $packItem->id_pack_product_attribute ? Product::getCombinationImageById($packItem->id_pack_product_attribute, $id_lang) : Product::getCover($packItem->id);
            $packItem->image = Context::getContext()->link->getImageLink($packItem->link_rewrite, $cover ? $cover['id_image'] : '', 'home_default');
        }

        return $packItems;
    }
}
