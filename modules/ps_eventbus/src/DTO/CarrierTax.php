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


namespace PrestaShop\Module\PsEventbus\DTO;

use JsonSerializable;

class CarrierTax implements JsonSerializable
{
    /**
     * @var string
     */
    private $collection = 'carrier_taxes';

    /**
     * @var int
     */
    private $carrierReference;

    /**
     * @var int
     */
    private $taxRulesGroupId;

    /**
     * @var int
     */
    private $zoneId;

    /**
     * @var string
     */
    private $countryIsoCode;

    /**
     * @var string
     */
    private $stateIsoCodes;

    /**
     * @var float
     */
    private $taxRate;

    /**
     * @return string
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param string $collection
     *
     * @return CarrierTax
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * @return int
     */
    public function getCarrierReference()
    {
        return $this->carrierReference;
    }

    /**
     * @param int $carrierReference
     *
     * @return CarrierTax
     */
    public function setCarrierReference($carrierReference)
    {
        $this->carrierReference = $carrierReference;

        return $this;
    }

    /**
     * @return int
     */
    public function getTaxRulesGroupId()
    {
        return $this->taxRulesGroupId;
    }

    /**
     * @param int $taxRulesGroupId
     *
     * @return CarrierTax
     */
    public function setTaxRulesGroupId($taxRulesGroupId)
    {
        $this->taxRulesGroupId = $taxRulesGroupId;

        return $this;
    }

    /**
     * @return int
     */
    public function getZoneId()
    {
        return $this->zoneId;
    }

    /**
     * @param int $zoneId
     *
     * @return CarrierTax
     */
    public function setZoneId($zoneId)
    {
        $this->zoneId = $zoneId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountryIsoCode()
    {
        return $this->countryIsoCode;
    }

    /**
     * @param string $countryIsoCode
     *
     * @return CarrierTax
     */
    public function setCountryIsoCode($countryIsoCode)
    {
        $this->countryIsoCode = $countryIsoCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getStateIsoCodes()
    {
        return $this->stateIsoCodes;
    }

    /**
     * @param string $stateIsoCodes
     *
     * @return CarrierTax
     */
    public function setStateIsoCodes($stateIsoCodes)
    {
        $this->stateIsoCodes = $stateIsoCodes;

        return $this;
    }

    /**
     * @return float
     */
    public function getTaxRate()
    {
        return $this->taxRate;
    }

    /**
     * @param float $taxRate
     *
     * @return CarrierTax
     */
    public function setTaxRate($taxRate)
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'collection' => $this->getCollection(),
            'id' => $this->getCarrierReference() . '-' . $this->getZoneId(),
            'properties' => [
                'id_reference' => (string) $this->getCarrierReference(),
                'id_carrier_tax' => (string) $this->getTaxRulesGroupId(),
                'country_id' => (string) $this->getCountryIsoCode(),
                'state_ids' => (string) $this->getStateIsoCodes(),
                'tax_rate' => (float) $this->getTaxRate(),
            ],
        ];
    }
}
