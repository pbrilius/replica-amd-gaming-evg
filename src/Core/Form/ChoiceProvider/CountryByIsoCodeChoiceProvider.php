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

namespace PrestaShop\PrestaShop\Core\Form\ChoiceProvider;

use PrestaShop\PrestaShop\Adapter\Country\CountryDataProvider;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;

/**
 * Class CountryChoiceProvider is responsible for providing both enabled/disabled country choices with ISO code values.
 */
final class CountryByIsoCodeChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * @var CountryDataProvider
     */
    private $countryDataProvider;

    /**
     * @var int
     */
    private $langId;

    /**
     * @param int $langId
     * @param CountryDataProvider $countryDataProvider
     */
    public function __construct(
        $langId,
        CountryDataProvider $countryDataProvider
    ) {
        $this->countryDataProvider = $countryDataProvider;
        $this->langId = $langId;
    }

    /**
     * Get country choices.
     *
     * @return array
     */
    public function getChoices()
    {
        $choices = [];
        $countries = $this->countryDataProvider->getCountries($this->langId);

        foreach ($countries as $country) {
            $choices[$country['name']] = $country['iso_code'];
        }

        return $choices;
    }
}
