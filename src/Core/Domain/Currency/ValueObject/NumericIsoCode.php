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

namespace PrestaShop\PrestaShop\Core\Domain\Currency\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Currency\Exception\CurrencyConstraintException;

/**
 * Class NumericIsoCode
 */
class NumericIsoCode
{
    /**
     * @var string Numeric ISO Code validation pattern
     */
    const PATTERN = '/^[0-9]{3}$/';

    /**
     * @var string
     */
    private $numericIsoCode;

    /**
     * @param string $numericIsoCode
     *
     * @throws CurrencyConstraintException
     */
    public function __construct($numericIsoCode)
    {
        $this->assertIsValidNumericIsoCode($numericIsoCode);
        $this->numericIsoCode = $numericIsoCode;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->numericIsoCode;
    }

    /**
     * @param string $numericIsoCode
     *
     * @throws CurrencyConstraintException
     */
    private function assertIsValidNumericIsoCode($numericIsoCode)
    {
        if (!is_string($numericIsoCode) || !preg_match(self::PATTERN, $numericIsoCode)) {
            throw new CurrencyConstraintException(sprintf('Given numeric iso code "%s" is not valid. It must be a string composed of three digits', var_export($numericIsoCode, true)), CurrencyConstraintException::INVALID_NUMERIC_ISO_CODE);
        }
    }
}
