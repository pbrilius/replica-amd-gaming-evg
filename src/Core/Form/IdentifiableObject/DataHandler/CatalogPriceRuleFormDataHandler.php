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

namespace PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler;

use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;
use PrestaShop\PrestaShop\Core\Domain\CatalogPriceRule\Command\AddCatalogPriceRuleCommand;
use PrestaShop\PrestaShop\Core\Domain\CatalogPriceRule\Command\EditCatalogPriceRuleCommand;
use PrestaShop\PrestaShop\Core\Domain\CatalogPriceRule\Exception\CatalogPriceRuleException;
use PrestaShop\PrestaShop\Core\Domain\CatalogPriceRule\ValueObject\CatalogPriceRuleId;

/**
 * Handles submitted catalog price rule form data
 */
final class CatalogPriceRuleFormDataHandler implements FormDataHandlerInterface
{
    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @var bool
     */
    private $isMultishopEnabled;

    /**
     * @var int
     */
    private $contextShopId;

    /**
     * @param CommandBusInterface $commandBus
     * @param bool $isMultishopEnabled
     * @param int $contextShopId
     */
    public function __construct(
        CommandBusInterface $commandBus,
        bool $isMultishopEnabled,
        int $contextShopId
    ) {
        $this->commandBus = $commandBus;
        $this->contextShopId = $contextShopId;
        $this->isMultishopEnabled = $isMultishopEnabled;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data): int
    {
        if (!$this->isMultishopEnabled) {
            $data['id_shop'] = $this->contextShopId;
        }

        if ($data['leave_initial_price']) {
            $data['price'] = -1;
        }

        $command = new AddCatalogPriceRuleCommand(
            $data['name'],
            (int) $data['id_currency'],
            (int) $data['id_country'],
            (int) $data['id_group'],
            (int) $data['from_quantity'],
            $data['reduction']['type'],
            (float) $data['reduction']['value'],
            (int) $data['id_shop'],
            (bool) $data['include_tax'],
            (float) $data['price']
        );

        if ($data['date_range']['from']) {
            $command->setDateTimeFrom($data['date_range']['from']);
        }

        if ($data['date_range']['to']) {
            $command->setDateTimeTo($data['date_range']['to']);
        }

        /** @var CatalogPriceRuleId $catalogPriceRuleId */
        $catalogPriceRuleId = $this->commandBus->handle($command);

        return $catalogPriceRuleId->getValue();
    }

    /**
     * {@inheritdoc}
     *
     * @throws CatalogPriceRuleException
     */
    public function update($catalogPriceRuleId, array $data)
    {
        $editCatalogPriceRuleCommand = new EditCatalogPriceRuleCommand((int) $catalogPriceRuleId);
        $this->fillCommandWithData($editCatalogPriceRuleCommand, $data);

        $this->commandBus->handle($editCatalogPriceRuleCommand);
    }

    /**
     * @param EditCatalogPriceRuleCommand $command
     * @param array $data
     *
     * @throws CatalogPriceRuleException
     */
    private function fillCommandWithData(EditCatalogPriceRuleCommand $command, array $data)
    {
        if ($data['leave_initial_price']) {
            $data['price'] = -1;
        }

        $command->setName($data['name']);
        $command->setShopId((int) $data['id_shop']);
        $command->setCurrencyId((int) $data['id_currency']);
        $command->setCountryId((int) $data['id_country']);
        $command->setGroupId((int) $data['id_group']);
        $command->setFromQuantity((int) $data['from_quantity']);
        $command->setPrice((float) $data['price']);
        $command->setIncludeTax((bool) $data['include_tax']);
        $command->setReduction($data['reduction']['type'], (float) $data['reduction']['value']);

        if ($data['date_range']['from']) {
            $command->setDateTimeFrom($data['date_range']['from']);
        }

        if ($data['date_range']['to']) {
            $command->setDateTimeTo($data['date_range']['to']);
        }
    }
}
