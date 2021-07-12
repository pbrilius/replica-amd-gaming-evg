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

use PrestaShop\PrestaShop\Adapter\Language\LanguageDataProvider;
use PrestaShop\PrestaShop\Adapter\Language\LanguageValidator;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use PrestaShop\PrestaShop\Core\Language\LanguageValidatorInterface;

/**
 * Class NonInstalledLocalizationChoiceProvider provides non installed localization choices
 * with name keys and iso code values.
 */
final class NonInstalledLocalizationChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * @var LanguageValidator
     */
    private $languageValidator;

    /**
     * @var LanguageDataProvider
     */
    private $languageProvider;
    /**
     * @var array
     */
    private $languagePackList;

    /**
     * @param array $languagePackList
     * @param LanguageValidatorInterface $languageValidator
     * @param LanguageDataProvider $languageProvider
     */
    public function __construct(
        array $languagePackList,
        LanguageValidatorInterface $languageValidator,
        LanguageDataProvider $languageProvider
    ) {
        $this->languageValidator = $languageValidator;
        $this->languageProvider = $languageProvider;
        $this->languagePackList = $languagePackList;
    }

    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        $choices = [];
        foreach (array_keys($this->languagePackList) as $locale) {
            if ($this->languageValidator->isInstalledByLocale($locale)) {
                continue;
            }

            $languageDetails = $this->languageProvider->getLanguageDetails($locale);

            if (isset($languageDetails['iso_code'], $languageDetails['name'])) {
                $choices[$languageDetails['name']] = $languageDetails['iso_code'];
            }
        }

        return $choices;
    }
}
