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

namespace PrestaShop\PrestaShop\Core\Domain\Manufacturer\QueryResult;

/**
 * Stores query result for getting manufacturer for viewing
 */
class ViewableManufacturer
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $manufacturerAddresses;

    /**
     * @var array
     */
    private $manufacturerProducts;

    /**
     * @param string $name
     * @param array $manufacturerAddresses
     * @param array $manufacturerProducts
     */
    public function __construct($name, array $manufacturerAddresses, array $manufacturerProducts)
    {
        $this->name = $name;
        $this->manufacturerAddresses = $manufacturerAddresses;
        $this->manufacturerProducts = $manufacturerProducts;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getManufacturerAddresses()
    {
        return $this->manufacturerAddresses;
    }

    /**
     * @return array
     */
    public function getManufacturerProducts()
    {
        return $this->manufacturerProducts;
    }
}
