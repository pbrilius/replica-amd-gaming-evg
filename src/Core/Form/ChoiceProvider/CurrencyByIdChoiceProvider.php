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

use PrestaShop\PrestaShop\Adapter\Currency\CurrencyDataProvider;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;

/**
 * Class CurrencyByIdChoiceProvider provides currency choices with ID values.
 */
final class CurrencyByIdChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * @var CurrencyDataProvider
     */
    private $currencyDataProvider;

    /**
     * @param CurrencyDataProvider $currencyDataProvider
     */
    public function __construct(CurrencyDataProvider $currencyDataProvider)
    {
        $this->currencyDataProvider = $currencyDataProvider;
    }

    /**
     * Get currency choices.
     *
     * @return array
     */
    public function getChoices()
    {
        $currencies = $this->currencyDataProvider->getCurrencies(false, true, true);
        $choices = [];

        foreach ($currencies as $currency) {
            $choices[sprintf('%s (%s)', $currency['name'], $currency['iso_code'])] = $currency['id_currency'];
        }

        return $choices;
    }
}
