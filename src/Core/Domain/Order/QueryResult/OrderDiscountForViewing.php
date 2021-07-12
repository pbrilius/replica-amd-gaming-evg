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

namespace PrestaShop\PrestaShop\Core\Domain\Order\QueryResult;

use PrestaShop\Decimal\Number;

class OrderDiscountForViewing
{
    /**
     * @var int
     */
    private $orderCartRuleId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $amountFormatted;

    /**
     * @var Number
     */
    private $amountRaw;

    public function __construct(
        int $orderCartRuleId,
        string $name,
        Number $amountRaw,
        string $amountFormatted
    ) {
        $this->orderCartRuleId = $orderCartRuleId;
        $this->name = $name;
        $this->amountFormatted = $amountFormatted;
        $this->amountRaw = $amountRaw;
    }

    /**
     * @return int
     */
    public function getOrderCartRuleId(): int
    {
        return $this->orderCartRuleId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAmountFormatted(): string
    {
        return $this->amountFormatted;
    }

    /**
     * @return Number
     */
    public function getAmountRaw(): Number
    {
        return $this->amountRaw;
    }
}
