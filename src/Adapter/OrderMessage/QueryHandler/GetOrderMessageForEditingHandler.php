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

namespace PrestaShop\PrestaShop\Adapter\OrderMessage\QueryHandler;

use PrestaShop\PrestaShop\Adapter\OrderMessage\AbstractOrderMessageHandler;
use PrestaShop\PrestaShop\Core\Domain\OrderMessage\Query\GetOrderMessageForEditing;
use PrestaShop\PrestaShop\Core\Domain\OrderMessage\QueryHandler\GetOrderMessageForEditingHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\OrderMessage\QueryResult\EditableOrderMessage;

/**
 * Get order message for editing using object model
 *
 * @internal
 */
final class GetOrderMessageForEditingHandler extends AbstractOrderMessageHandler implements GetOrderMessageForEditingHandlerInterface
{
    /**
     * @param GetOrderMessageForEditing $query
     *
     * @return EditableOrderMessage
     */
    public function handle(GetOrderMessageForEditing $query): EditableOrderMessage
    {
        $orderMessage = $this->getOrderMessage($query->getOrderMessageId());

        return new EditableOrderMessage(
            $query->getOrderMessageId(),
            $orderMessage->name,
            $orderMessage->message
        );
    }
}
