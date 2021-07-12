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

namespace PrestaShop\PrestaShop\Adapter\Address\CommandHandler;

use PrestaShop\PrestaShop\Adapter\Address\AbstractAddressHandler;
use PrestaShop\PrestaShop\Core\Domain\Address\Command\DeleteAddressCommand;
use PrestaShop\PrestaShop\Core\Domain\Address\CommandHandler\DeleteAddressHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Address\Exception\DeleteAddressException;

/**
 * Handles command which deletes address
 */
final class DeleteAddressHandler extends AbstractAddressHandler implements DeleteAddressHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(DeleteAddressCommand $command)
    {
        $addressId = $command->getAddressId();
        $address = $this->getAddress($addressId);

        if (!$this->deleteAddress($address)) {
            throw new DeleteAddressException(sprintf('Cannot delete Address object with id "%s".', $addressId->getValue()), DeleteAddressException::FAILED_DELETE);
        }
    }
}
