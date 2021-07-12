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


namespace PrestaShop\Module\PsEventbus\Provider;

use Carrier;
use Currency;
use Language;
use PrestaShop\Module\PsEventbus\Builder\CarrierBuilder;
use PrestaShop\Module\PsEventbus\DTO\Carrier as EventBusCarrier;
use PrestaShop\Module\PsEventbus\Repository\CarrierRepository;
use PrestaShop\Module\PsEventbus\Repository\ConfigurationRepository;

class CarrierDataProvider implements PaginatedApiDataProviderInterface
{
    /**
     * @var ConfigurationRepository
     */
    private $configurationRepository;

    /**
     * @var CarrierBuilder
     */
    private $carrierBuilder;

    /**
     * @var CarrierRepository
     */
    private $carrierRepository;

    public function __construct(
        ConfigurationRepository $configurationRepository,
        CarrierBuilder $carrierBuilder,
        CarrierRepository $carrierRepository
    ) {
        $this->configurationRepository = $configurationRepository;
        $this->carrierBuilder = $carrierBuilder;
        $this->carrierRepository = $carrierRepository;
    }

    /**
     * @param int $offset
     * @param int $limit
     * @param string $langIso
     *
     * @return array
     *
     * @throws \PrestaShopDatabaseException
     */
    public function getFormattedData($offset, $limit, $langIso)
    {
        $language = new Language($this->configurationRepository->get('PS_LANG_DEFAULT'));
        $currency = new Currency($this->configurationRepository->get('PS_CURRENCY_DEFAULT'));

        $carriers = Carrier::getCarriers($language->id);

        /** @var EventBusCarrier[] $eventBusCarriers */
        $eventBusCarriers = $this->carrierBuilder->buildCarriers(
            $carriers,
            $language,
            $currency,
            $this->configurationRepository->get('PS_WEIGHT_UNIT')
        );

        return $eventBusCarriers;
    }

    public function getFormattedDataIncremental($limit, $langIso, $objectIds)
    {
        $shippingIncremental = $this->carrierRepository->getShippingIncremental('carrier', $langIso);

        if (!$shippingIncremental) {
            return [];
        }

        $language = new Language($this->configurationRepository->get('PS_LANG_DEFAULT'));
        $currency = new Currency($this->configurationRepository->get('PS_CURRENCY_DEFAULT'));

        $carriers = Carrier::getCarriers($language->id);

        /** @var EventBusCarrier[] $eventBusCarriers */
        $eventBusCarriers = $this->carrierBuilder->buildCarriers(
            $carriers,
            $language,
            $currency,
            $this->configurationRepository->get('PS_WEIGHT_UNIT')
        );

        return $eventBusCarriers;
    }

    public function getRemainingObjectsCount($offset, $langIso)
    {
        return 0;
    }
}
