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

namespace PrestaShopBundle\Translation\Provider;

use Symfony\Component\Translation\MessageCatalogueInterface;

/**
 * Defines what should be the default catalogue, contains all the translations keys.
 */
interface UseDefaultCatalogueInterface
{
    /**
     * Get the default (aka untranslated) catalogue
     *
     * @param bool $empty if true, empty the catalogue values (keep the keys)
     *
     * @return MessageCatalogueInterface Return a default catalogue with all keys
     */
    public function getDefaultCatalogue($empty = true);

    /**
     * @return string Path to the default directory
     *                Most of the time, it's `app/Resources/translations/default/{locale}`
     */
    public function getDefaultResourceDirectory();
}
