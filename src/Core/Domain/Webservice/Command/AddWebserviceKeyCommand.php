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

namespace PrestaShop\PrestaShop\Core\Domain\Webservice\Command;

use PrestaShop\PrestaShop\Core\Domain\Webservice\ValueObject\Key;

/**
 * Adds new webservice key which is used to access PrestaShop's API
 */
class AddWebserviceKeyCommand
{
    /**
     * @var Key
     */
    private $key;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $status;

    /**
     * @var array
     */
    private $permissions;

    /**
     * @var array
     */
    private $associatedShops;

    /**
     * @param string $key
     * @param string $description
     * @param bool $status
     * @param array $permissions
     * @param int[] $associatedShops
     */
    public function __construct(
        $key,
        $description,
        $status,
        array $permissions,
        array $associatedShops
    ) {
        $this->key = new Key($key);
        $this->description = $description;
        $this->status = $status;
        $this->permissions = $permissions;
        $this->associatedShops = $associatedShops;
    }

    /**
     * @return Key
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @return array
     */
    public function getAssociatedShops()
    {
        return $this->associatedShops;
    }
}
