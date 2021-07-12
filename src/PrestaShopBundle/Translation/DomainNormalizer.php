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

namespace PrestaShopBundle\Translation;

use RuntimeException;

/**
 * Normalizes domain names by removing dots
 */
class DomainNormalizer
{
    /**
     * @param string $domain Domain name
     *
     * @return string
     *
     * @throws RuntimeException
     */
    public function normalize($domain)
    {
        // remove up to two dots from the domain name
        // (because legacy domain translations CAN have dots in the third part)
        $normalizedDomain = preg_replace('/\./', '', $domain, 2);

        if ($normalizedDomain === null) {
            throw new RuntimeException(sprintf('An error occurred while normalizing domain "%s"', $domain));
        }

        return $normalizedDomain;
    }
}
