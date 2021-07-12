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

namespace PrestaShop\PrestaShop\Adapter;

use Address;

/**
 * Class responsible of creation of Address ObjectModel.
 */
class AddressFactory
{
    /**
     * Initialize an address corresponding to the specified id address or if empty to the
     * default shop configuration.
     *
     * @param int|null $id_address
     * @param bool $with_geoloc
     *
     * @return Address
     */
    public function findOrCreate($id_address = null, $with_geoloc = false)
    {
        $func_args = func_get_args();

        return call_user_func_array(['\\Address', 'initialize'], $func_args);
    }

    /**
     * Check if an address exists depending on given $id_address.
     *
     * @param $id_address
     *
     * @return bool
     */
    public function addressExists($id_address)
    {
        return Address::addressExists($id_address);
    }
}
