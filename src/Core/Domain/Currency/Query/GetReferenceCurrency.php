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

namespace PrestaShop\PrestaShop\Core\Domain\Currency\Query;

use PrestaShop\PrestaShop\Core\Domain\Currency\Exception\CurrencyException;
use PrestaShop\PrestaShop\Core\Domain\Currency\ValueObject\AlphaIsoCode;

/**
 * Get reference currency data, which are data from the unicode CLDR database, thus
 * only official currencies have one. The result is exposed with a ReferenceCurrency
 * object, and if the currency doesn't exist a CurrencyNotFoundException is thrown.
 */
class GetReferenceCurrency
{
    /**
     * @var AlphaIsoCode
     */
    private $isoCode;

    /**
     * @param string $isoCode
     *
     * @throws CurrencyException
     */
    public function __construct(string $isoCode)
    {
        $this->isoCode = new AlphaIsoCode($isoCode);
    }

    /**
     * @return AlphaIsoCode
     */
    public function getIsoCode(): AlphaIsoCode
    {
        return $this->isoCode;
    }
}
