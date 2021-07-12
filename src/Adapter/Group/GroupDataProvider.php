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

namespace PrestaShop\PrestaShop\Adapter\Group;

use Group;

/**
 * This class will provide data from DB / ORM about Group.
 */
class GroupDataProvider
{
    /**
     * Return available groups.
     *
     * @param int $id_lang
     * @param bool $id_shop
     *
     * @return array Groups
     */
    public function getGroups($id_lang, $id_shop = false)
    {
        return Group::getGroups($id_lang, $id_shop);
    }

    /**
     * Return current group object
     * Use context.
     *
     * @return Group Group object
     */
    public static function getCurrent()
    {
        return Group::getCurrent();
    }
}
