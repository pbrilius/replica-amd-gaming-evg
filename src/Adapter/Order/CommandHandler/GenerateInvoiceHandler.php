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

namespace PrestaShop\PrestaShop\Adapter\Order\CommandHandler;

use Configuration;
use PrestaShop\PrestaShop\Adapter\Order\AbstractOrderHandler;
use PrestaShop\PrestaShop\Core\Domain\Order\Exception\OrderException;
use PrestaShop\PrestaShop\Core\Domain\Order\Invoice\Command\GenerateInvoiceCommand;
use PrestaShop\PrestaShop\Core\Domain\Order\Invoice\CommandHandler\GenerateOrderInvoiceHandlerInterface;

/**
 * @internal
 */
final class GenerateInvoiceHandler extends AbstractOrderHandler implements GenerateOrderInvoiceHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(GenerateInvoiceCommand $command)
    {
        $order = $this->getOrder($command->getOrderId());

        if (!Configuration::get('PS_INVOICE', null, null, $order->id_shop)) {
            throw new OrderException('Invoice management has been disabled.');
        }

        if ($order->hasInvoice()) {
            throw new OrderException('This order already has an invoice.');
        }

        $order->setInvoice(true);
    }
}
