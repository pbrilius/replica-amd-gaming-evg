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

namespace PrestaShop\PrestaShop\Core\Domain\Order\Command;

use PrestaShop\PrestaShop\Core\Domain\Address\ValueObject\AddressId;
use PrestaShop\PrestaShop\Core\Domain\Order\ValueObject\OrderId;

/**
 * Changes delivery address for given order.
 */
class ChangeOrderDeliveryAddressCommand
{
    /**
     * @var OrderId
     */
    private $orderId;

    /**
     * @var AddressId
     */
    private $newDeliveryAddressId;

    /**
     * @param int $orderId
     * @param int $newDeliveryAddressId
     */
    public function __construct($orderId, $newDeliveryAddressId)
    {
        $this->orderId = new OrderId($orderId);
        $this->newDeliveryAddressId = new AddressId($newDeliveryAddressId);
    }

    /**
     * @return OrderId
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return AddressId
     */
    public function getNewDeliveryAddressId()
    {
        return $this->newDeliveryAddressId;
    }
}
