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

namespace PrestaShop\PrestaShop\Core\Domain\Address\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Address\Exception\AddressConstraintException;

/**
 * Provides address id
 */
class AddressId
{
    /**
     * @var int
     */
    private $addressId;

    /**
     * @param int $addressId
     *
     * @throws AddressConstraintException
     */
    public function __construct($addressId)
    {
        $this->assertIsIntegerGreaterThanZero($addressId);
        $this->addressId = $addressId;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->addressId;
    }

    /**
     * Validates that the value is integer and is greater than zero
     *
     * @param $value
     *
     * @throws AddressConstraintException
     */
    private function assertIsIntegerGreaterThanZero($value)
    {
        if (!is_int($value) || 0 >= $value) {
            throw new AddressConstraintException(sprintf('Invalid address id "%s".', var_export($value, true)), AddressConstraintException::INVALID_ID);
        }
    }
}
