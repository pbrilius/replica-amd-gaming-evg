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

use PrestaShop\PrestaShop\Core\Exception\FileNotFoundException;
use Symfony\Component\Translation\MessageCatalogue;

/**
 * Helper used to retrieve a Symfony Catalogue object.
 *
 * @deprecated use TraslationFinder instead
 */
trait TranslationFinderTrait
{
    /**
     * @param array $paths a list of paths when we can look for translations
     * @param string $locale the Symfony (not the PrestaShop one) locale
     * @param string|null $pattern a regular expression
     *
     * @return MessageCatalogue
     *
     * @throws FileNotFoundException
     *
     * @deprecated use TraslationFinder::getCatalogueFromPaths() instead
     */
    public function getCatalogueFromPaths($paths, $locale, $pattern = null)
    {
        @trigger_error(
            __FUNCTION__ . 'is deprecated since version 1.7.6.1 Use TranslationFinder::getCatalogueFromPaths() instead.',
            E_USER_DEPRECATED
        );

        return (new TranslationFinder())->getCatalogueFromPaths($paths, $locale, $pattern);
    }
}
