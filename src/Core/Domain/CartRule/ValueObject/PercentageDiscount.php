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

namespace PrestaShop\PrestaShop\Core\Domain\CartRule\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\CartRule\Exception\CartRuleConstraintException;

/**
 * Percentage discount
 */
class PercentageDiscount
{
    /**
     * @var float
     */
    private $percentage;

    /**
     * @var bool
     */
    private $appliesToDiscountedProducts;

    /**
     * @param float $percentage
     * @param bool $appliesToDiscountedProducts
     */
    public function __construct(float $percentage, bool $appliesToDiscountedProducts)
    {
        if ($percentage <= 0 || $percentage > 100) {
            throw new CartRuleConstraintException('Percentage must be greater than 0 and not greater than 100', CartRuleConstraintException::INVALID_PERCENTAGE);
        }

        $this->percentage = $percentage;
        $this->appliesToDiscountedProducts = $appliesToDiscountedProducts;
    }

    /**
     * @return float
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }

    /**
     * @return bool
     */
    public function appliesToDiscountedProducts(): bool
    {
        return $this->appliesToDiscountedProducts;
    }
}
