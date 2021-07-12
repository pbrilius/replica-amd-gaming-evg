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

use DateTimeImmutable;

class OrderReturnForViewing
{
    /**
     * @var int
     */
    private $orderInvoiceId;

    /**
     * @var int
     */
    private $carrierId;

    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $stateName;

    /**
     * @var string|null
     */
    private $trackingUrl;

    /**
     * @var string|null
     */
    private $trackingNumber;

    /**
     * @var int
     */
    private $idOrderReturn;

    /**
     * @param int $idOrderReturn
     * @param int $orderInvoiceId
     * @param int $carrierId
     * @param DateTimeImmutable $date
     * @param string $type
     * @param string $stateName
     * @param string|null $trackingUrl
     * @param string|null $trackingNumber
     */
    public function __construct(
        int $idOrderReturn,
        int $orderInvoiceId,
        int $carrierId,
        DateTimeImmutable $date,
        string $type,
        string $stateName,
        ?string $trackingUrl,
        ?string $trackingNumber
    ) {
        $this->orderInvoiceId = $orderInvoiceId;
        $this->carrierId = $carrierId;
        $this->date = $date;
        $this->type = $type;
        $this->stateName = $stateName;
        $this->trackingUrl = $trackingUrl;
        $this->trackingNumber = $trackingNumber;
        $this->idOrderReturn = $idOrderReturn;
    }

    /**
     * @return int
     */
    public function getOrderInvoiceId(): int
    {
        return $this->orderInvoiceId;
    }

    /**
     * @return int
     */
    public function getCarrierId(): int
    {
        return $this->carrierId;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getStateName(): string
    {
        return $this->stateName;
    }

    /**
     * @return string|null
     */
    public function getTrackingUrl(): ?string
    {
        return $this->trackingUrl;
    }

    /**
     * @return string|null
     */
    public function getTrackingNumber(): ?string
    {
        return $this->trackingNumber;
    }

    /**
     * @return int
     */
    public function getIdOrderReturn(): int
    {
        return $this->idOrderReturn;
    }
}
