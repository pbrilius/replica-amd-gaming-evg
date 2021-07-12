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
use PrestaShop\PrestaShop\Core\Form\ConfigurableFormChoiceProviderInterface;

/**
 * Class LanguageByIdChoiceProvider provides active language choices with ID values.
 */
final class LanguageByIdChoiceProvider implements ConfigurableFormChoiceProviderInterface
{
    /**
     * @var LanguageDataProvider
     */
    private $languageDataProvider;

    /**
     * LanguageByIdChoiceProvider constructor.
     *
     * @param LanguageDataProvider $languageDataProvider
     */
    public function __construct(LanguageDataProvider $languageDataProvider)
    {
        $this->languageDataProvider = $languageDataProvider;
    }

    /**
     * Get active language choices for form.
     *
     * @return array
     */
    public function getChoices(array $options = [])
    {
        $choices = [];
        $shopId = isset($options['shop_id']) && (int) $options['shop_id'] > 0 ? $options['shop_id'] : false;
        foreach ($this->languageDataProvider->getLanguages(true, $shopId) as $language) {
            $choices[$language['name']] = $language['id_lang'];
        }

        return $choices;
    }
}
