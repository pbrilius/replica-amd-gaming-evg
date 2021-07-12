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

namespace PrestaShop\PrestaShop\Core\Domain\Address\Command;

use PrestaShop\PrestaShop\Core\Domain\Address\Exception\AddressConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Address\ValueObject\AddressId;

/**
 * Deletes addresses in bulk action
 */
class BulkDeleteAddressCommand
{
    /**
     * @var AddressId[]
     */
    private $addressIds;

    /**
     * @param int[] $addressIds
     *
     * @throws AddressConstraintException
     */
    public function __construct($addressIds)
    {
        $this->setAddressIds($addressIds);
    }

    /**
     * @return AddressId[]
     */
    public function getAdressIds()
    {
        return $this->addressIds;
    }

    /**
     * @param int[] $addressIds
     *
     * @throws AddressConstraintException
     */
    private function setAddressIds(array $addressIds)
    {
        foreach ($addressIds as $addressId) {
            $this->addressIds[] = new AddressId($addressId);
        }
    }
}
