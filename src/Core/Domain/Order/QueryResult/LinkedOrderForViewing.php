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

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Core\Domain\Order\QueryResult;

/**
 * Used in order page view to display 'linked orders': orders linked
 * to the order being displayed
 *
 * Two orders are linked if they are the result of an Order Split
 */
class LinkedOrderForViewing
{
    /**
     * @var int
     */
    private $orderId;

    /**
     * @var string
     */
    private $statusName;

    /**
     * @var string
     */
    private $amount;

    /**
     * @param int $orderId
     * @param string $statusName
     * @param string $amount
     */
    public function __construct(int $orderId, string $statusName, string $amount)
    {
        $this->orderId = $orderId;
        $this->statusName = $statusName;
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getStatusName(): string
    {
        return $this->statusName;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }
}
