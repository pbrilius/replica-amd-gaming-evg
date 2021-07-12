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

namespace PrestaShop\PrestaShop\Adapter\Customer\CommandHandler;

use Customer;
use PrestaShop\PrestaShop\Core\Domain\Customer\Command\SetRequiredFieldsForCustomerCommand;
use PrestaShop\PrestaShop\Core\Domain\Customer\CommandHandler\SetRequiredFieldsForCustomerHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Customer\Exception\CannotSetRequiredFieldsForCustomerException;

/**
 * Handles command which sets required fields for customer.
 *
 * @internal
 */
final class SetRequiredFieldsForCustomerHandler implements SetRequiredFieldsForCustomerHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(SetRequiredFieldsForCustomerCommand $command)
    {
        $customer = new Customer();

        if (!$customer->addFieldsRequiredDatabase($command->getRequiredFields())) {
            throw new CannotSetRequiredFieldsForCustomerException(sprintf('Cannot set "%s" required fields for customer', implode(',', $command->getRequiredFields())));
        }
    }
}
