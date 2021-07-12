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

namespace PrestaShop\PrestaShop\Adapter\CatalogPriceRule\CommandHandler;

use PrestaShop\PrestaShop\Adapter\CatalogPriceRule\AbstractCatalogPriceRuleHandler;
use PrestaShop\PrestaShop\Core\Domain\CatalogPriceRule\Command\DeleteCatalogPriceRuleCommand;
use PrestaShop\PrestaShop\Core\Domain\CatalogPriceRule\CommandHandler\DeleteCatalogPriceRuleHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\CatalogPriceRule\Exception\CannotDeleteCatalogPriceRuleException;

/**
 * Handles deletion of catalog price rule using legacy object model
 */
final class DeleteCatalogPriceRuleHandler extends AbstractCatalogPriceRuleHandler implements DeleteCatalogPriceRuleHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(DeleteCatalogPriceRuleCommand $command)
    {
        $catalogPriceRuleId = $command->getCatalogPriceRuleId();
        $specificPriceRule = $this->getSpecificPriceRule($catalogPriceRuleId);

        if (null === $this->deleteSpecificPriceRule($specificPriceRule)) {
            throw new CannotDeleteCatalogPriceRuleException(sprintf('Cannot delete SpecificPriceRule object with id "%s".', $catalogPriceRuleId->getValue()), CannotDeleteCatalogPriceRuleException::FAILED_DELETE);
        }
    }
}
