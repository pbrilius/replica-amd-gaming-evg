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

use PrestaShop\PrestaShop\Core\Domain\Manufacturer\Command\BulkToggleManufacturerStatusCommand;
use PrestaShop\PrestaShop\Core\Domain\Manufacturer\CommandHandler\BulkToggleManufacturerStatusHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Manufacturer\Exception\UpdateManufacturerException;

/**
 * Handles command which toggles manufacturer status in bulk action
 */
final class BulkToggleManufacturerStatusHandler extends AbstractManufacturerCommandHandler implements BulkToggleManufacturerStatusHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(BulkToggleManufacturerStatusCommand $command)
    {
        foreach ($command->getManufacturerIds() as $manufacturerId) {
            $manufacturer = $this->getManufacturer($manufacturerId);

            if (!$this->toggleManufacturerStatus($manufacturer, $command->getExpectedStatus())) {
                throw new UpdateManufacturerException(sprintf('Unable to toggle manufacturer status with id "%s"', $manufacturer->id), UpdateManufacturerException::FAILED_BULK_UPDATE_STATUS);
            }
        }
    }
}
