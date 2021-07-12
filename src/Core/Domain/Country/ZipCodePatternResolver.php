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

namespace PrestaShop\PrestaShop\Core\Domain\Country;

/**
 * Call responsible for resolving country zip code format and returning it as other usable patterns
 */
final class ZipCodePatternResolver implements ZipCodePatternResolverInterface
{
    /**
     * @param string $format
     * @param string $isoCode
     *
     * @return string
     */
    public function getRegexPattern(string $format, string $isoCode): string
    {
        return str_replace(['N', 'L', 'C'], ['[0-9]', '[a-zA-Z]', $isoCode], '/^' . $format . '$/ui');
    }

    /**
     * @param string $format
     * @param string $isoCode
     *
     * @return string
     */
    public function getHumanReadablePattern(string $format, string $isoCode): string
    {
        return str_replace(['N', 'L',  'C'], ['0', 'A', $isoCode], $format);
    }
}
