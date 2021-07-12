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

namespace PrestaShop\PrestaShop\Adapter\OrderMessage;

use OrderMessage;
use PrestaShop\PrestaShop\Core\Domain\OrderMessage\Exception\OrderMessageNotFoundException;
use PrestaShop\PrestaShop\Core\Domain\OrderMessage\ValueObject\OrderMessageId;

/**
 * Provides common methods for OrderMessage command/query handlers that uses object model
 *
 * @internal
 */
abstract class AbstractOrderMessageHandler
{
    /**
     * @param OrderMessageId $orderMessageId
     *
     * @return OrderMessage
     */
    protected function getOrderMessage(OrderMessageId $orderMessageId): OrderMessage
    {
        $orderMessage = new OrderMessage($orderMessageId->getValue());

        if ($orderMessage->id !== $orderMessageId->getValue()) {
            throw new OrderMessageNotFoundException($orderMessageId, sprintf('Order message with id "%s" was not found', $orderMessageId->getValue()));
        }

        return $orderMessage;
    }
}
