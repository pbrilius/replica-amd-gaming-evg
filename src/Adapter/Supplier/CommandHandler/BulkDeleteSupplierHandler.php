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

namespace PrestaShop\PrestaShop\Adapter\Supplier\CommandHandler;

use PrestaShop\PrestaShop\Core\Domain\Supplier\Command\BulkDeleteSupplierCommand;
use PrestaShop\PrestaShop\Core\Domain\Supplier\CommandHandler\BulkDeleteSupplierHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Supplier\Exception\CannotDeleteSupplierException;
use PrestaShop\PrestaShop\Core\Domain\Supplier\Exception\SupplierException;

/**
 * Class BulkDeleteSupplierHandler is responsible for deleting multiple suppliers.
 */
final class BulkDeleteSupplierHandler extends AbstractDeleteSupplierHandler implements BulkDeleteSupplierHandlerInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws SupplierException
     */
    public function handle(BulkDeleteSupplierCommand $command)
    {
        foreach ($command->getSupplierIds() as $supplierId) {
            try {
                $this->removeSupplier($supplierId);
            } catch (SupplierException $e) {
                if (SupplierException::class === get_class($e)) {
                    throw new CannotDeleteSupplierException(sprintf('Cannot delete Supplier object with id "%s".', $supplierId->getValue()), CannotDeleteSupplierException::FAILED_BULK_DELETE);
                }

                throw $e;
            }
        }
    }
}
