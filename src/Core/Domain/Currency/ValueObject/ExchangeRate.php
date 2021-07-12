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

use PrestaShop\Decimal\Number;
use PrestaShop\PrestaShop\Core\Domain\Currency\Exception\CurrencyConstraintException;

/**
 * Class ExchangeRate
 */
class ExchangeRate
{
    const DEFAULT_RATE = 1.0;

    /**
     * Get the default exchange rate as a Number
     *
     * @return Number
     */
    public static function getDefaultExchangeRate(): Number
    {
        return new Number((string) self::DEFAULT_RATE);
    }

    /**
     * @var float
     */
    private $exchangeRate;

    /**
     * @param float $exchangeRate
     *
     * @throws CurrencyConstraintException
     */
    public function __construct($exchangeRate)
    {
        $this->assertIsNumberAndMoreThanZero($exchangeRate);
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->exchangeRate;
    }

    /**
     * @param float|int $exchangeRate
     *
     * @throws CurrencyConstraintException
     */
    private function assertIsNumberAndMoreThanZero($exchangeRate)
    {
        $isIntegerOrFloat = is_int($exchangeRate) || is_float($exchangeRate);

        if (!$isIntegerOrFloat || 0 >= $exchangeRate) {
            throw new CurrencyConstraintException(sprintf('Given exchange rate %s is not valid. It must be more than 0', var_export($exchangeRate, true)), CurrencyConstraintException::INVALID_EXCHANGE_RATE);
        }
    }
}
