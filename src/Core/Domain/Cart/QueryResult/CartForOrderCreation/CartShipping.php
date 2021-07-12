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

namespace PrestaShop\PrestaShop\Core\Domain\Cart\QueryResult\CartForOrderCreation;

/**
 * Holds data for cart shipping information
 */
class CartShipping
{
    /**
     * @var ?int
     */
    private $selectedCarrierId;

    /**
     * @var string
     */
    private $shippingPrice;

    /**
     * @var bool
     */
    private $freeShipping;

    /**
     * @var CartDeliveryOption[]
     */
    private $deliveryOptions;

    /**
     * @var bool
     */
    private $isRecycledPackaging;

    /**
     * @var bool
     */
    private $isGift;

    /**
     * @var string
     */
    private $giftMessage;

    /**
     * @param string $shippingPrice
     * @param bool $freeShipping
     * @param CartDeliveryOption[] $deliveryOptions
     * @param int|null $selectedCarrierId
     * @param bool $isGift
     * @param bool $isRecycledPackaging
     * @param string $giftMessage
     */
    public function __construct(
        string $shippingPrice,
        bool $freeShipping,
        array $deliveryOptions,
        ?int $selectedCarrierId,
        bool $isGift,
        bool $isRecycledPackaging,
        string $giftMessage
    ) {
        $this->shippingPrice = $shippingPrice;
        $this->freeShipping = $freeShipping;
        $this->deliveryOptions = $deliveryOptions;
        $this->selectedCarrierId = $selectedCarrierId;
        $this->isGift = $isGift;
        $this->isRecycledPackaging = $isRecycledPackaging;
        $this->giftMessage = $giftMessage;
    }

    /**
     * @return string
     */
    public function getShippingPrice(): string
    {
        return $this->shippingPrice;
    }

    /**
     * @return bool
     */
    public function isFreeShipping(): bool
    {
        return $this->freeShipping;
    }

    /**
     * @return CartDeliveryOption[]
     */
    public function getDeliveryOptions(): array
    {
        return $this->deliveryOptions;
    }

    /**
     * @return mixed
     */
    public function getSelectedCarrierId()
    {
        return $this->selectedCarrierId;
    }

    /**
     * @return bool
     */
    public function isRecycledPackaging(): bool
    {
        return $this->isRecycledPackaging;
    }

    /**
     * @return bool
     */
    public function isGift(): bool
    {
        return $this->isGift;
    }

    /**
     * @return string
     */
    public function getGiftMessage(): string
    {
        return $this->giftMessage;
    }
}
