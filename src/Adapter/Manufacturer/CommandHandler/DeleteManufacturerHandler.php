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

namespace PrestaShop\PrestaShop\Adapter\Manufacturer\CommandHandler;

use PrestaShop\PrestaShop\Core\Domain\Manufacturer\Command\DeleteManufacturerCommand;
use PrestaShop\PrestaShop\Core\Domain\Manufacturer\CommandHandler\DeleteManufacturerHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Manufacturer\Exception\DeleteManufacturerException;

/**
 * Handles command which deletes manufacturer using legacy object model
 */
final class DeleteManufacturerHandler extends AbstractManufacturerCommandHandler implements DeleteManufacturerHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(DeleteManufacturerCommand $command)
    {
        $manufacturer = $this->getManufacturer($command->getManufacturerId());

        if (!$this->deleteManufacturer($manufacturer)) {
            throw new DeleteManufacturerException(sprintf('Cannot delete Manufacturer object with id "%s".', $manufacturer->id), DeleteManufacturerException::FAILED_DELETE);
        }
    }
}
