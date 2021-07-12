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

namespace PrestaShopBundle\Translation\Factory;

use PrestaShopBundle\Translation\Provider\AbstractProvider;
use PrestaShopBundle\Translation\View\TreeBuilder;

/**
 * This class returns a collection of translations, using a locale and an identifier.
 *
 * Returns MessageCatalogue object or Translation tree array.
 */
class TranslationsFactory implements TranslationsFactoryInterface
{
    /**
     * @var array the list of translation providers
     */
    private $providers = [];

    /**
     * {@inheritdoc}
     */
    public function createCatalogue($domainIdentifier, $locale = 'en_US')
    {
        foreach ($this->providers as $provider) {
            if ($domainIdentifier === $provider->getIdentifier()) {
                return $provider->setLocale($locale)->getMessageCatalogue();
            }
        }

        throw new ProviderNotFoundException($domainIdentifier);
    }

    /**
     * {@inheritdoc}
     */
    public function createTranslationsArray($domainIdentifier, $locale = self::DEFAULT_LOCALE, $theme = null, $search = null)
    {
        foreach ($this->providers as $provider) {
            if ($domainIdentifier === $provider->getIdentifier()) {
                $treeBuilder = new TreeBuilder($locale, $theme);

                return $treeBuilder->makeTranslationArray($provider, $search);
            }
        }

        throw new ProviderNotFoundException($domainIdentifier);
    }

    /**
     * @param AbstractProvider $provider
     */
    public function addProvider(AbstractProvider $provider)
    {
        $this->providers[] = $provider;
    }
}
