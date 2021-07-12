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

use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use PrestaShop\PrestaShop\Core\MailTemplate\ThemeCatalogInterface;
use PrestaShop\PrestaShop\Core\MailTemplate\ThemeCollectionInterface;
use PrestaShop\PrestaShop\Core\MailTemplate\ThemeInterface;

/**
 * Class MailThemeChoiceProvider is responsible to provide a list of available mail themes.
 */
class MailThemeChoiceProvider implements FormChoiceProviderInterface
{
    /** @var array */
    private $choices;

    /** @var ThemeCatalogInterface */
    private $themeCatalog;

    /**
     * @param ThemeCatalogInterface $themeCatalog
     */
    public function __construct(ThemeCatalogInterface $themeCatalog)
    {
        $this->themeCatalog = $themeCatalog;
    }

    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        if (null === $this->choices) {
            $this->choices = [];

            /** @var ThemeCollectionInterface $collection */
            $collection = $this->themeCatalog->listThemes();

            /** @var ThemeInterface $theme */
            foreach ($collection as $theme) {
                $this->choices[$theme->getName()] = $theme->getName();
            }
        }

        return $this->choices;
    }
}
