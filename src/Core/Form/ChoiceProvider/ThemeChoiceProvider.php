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

use PrestaShop\PrestaShop\Core\Addon\Theme\ThemeProviderInterface;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;

/**
 * Class ThemeChoiceProvider provides available themes as choices.
 */
final class ThemeChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * @var ThemeProviderInterface
     */
    private $themeProvider;

    /**
     * @param ThemeProviderInterface $themeProvider
     */
    public function __construct(ThemeProviderInterface $themeProvider)
    {
        $this->themeProvider = $themeProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        $usedTheme = $this->themeProvider->getCurrentlyUsedTheme();
        $notUsedThemes = $this->themeProvider->getNotUsedThemes();

        $choices = [];
        $choices[$usedTheme->getName()] = $usedTheme->getName();

        foreach ($notUsedThemes as $theme) {
            $choices[$theme->getName()] = $theme->getName();
        }

        return $choices;
    }
}
