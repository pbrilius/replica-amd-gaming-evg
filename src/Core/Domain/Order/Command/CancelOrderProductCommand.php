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

use PrestaShop\PrestaShop\Core\Domain\Order\ValueObject\OrderId;

class CancelOrderProductCommand
{
    /**
     * @var array
     *
     * key: orderDetailId, value: quantity
     */
    private $cancelledProducts;

    /**
     * @var OrderId
     */
    private $orderId;

    /**
     * CancelOrderProductCommand constructor.
     *
     * @param array $toBeCanceledProducts
     * @param int $orderId
     */
    public function __construct(array $cancelledProducts, int $orderId)
    {
        $this->cancelledProducts = $cancelledProducts;
        $this->orderId = new OrderId($orderId);
    }

    /**
     * @return array
     */
    public function getCancelledProducts()
    {
        return $this->cancelledProducts;
    }

    /**
     * @return OrderId
     */
    public function getOrderId()
    {
        return $this->orderId;
    }
}
