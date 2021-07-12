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

class OrderShippingForViewing
{
    /**
     * @var OrderCarrierForViewing[]
     */
    private $carriers = [];

    /**
     * @var bool
     */
    private $isRecycledPackaging;

    /**
     * @var bool
     */
    private $isGiftWrapping;

    /**
     * @var string|null
     */
    private $carrierModuleInfo;

    /**
     * @var string|null
     */
    private $giftMessage;

    /**
     * @param OrderCarrierForViewing[] $carriers
     * @param bool $isRecycledPackaging
     * @param bool $isGiftWrapping
     * @param string|null $giftMessage
     * @param string|null $carrierModuleInfo
     */
    public function __construct(
        array $carriers,
        bool $isRecycledPackaging,
        bool $isGiftWrapping,
        ?string $giftMessage,
        ?string $carrierModuleInfo
    ) {
        foreach ($carriers as $carrier) {
            $this->addCarrier($carrier);
        }

        $this->isRecycledPackaging = $isRecycledPackaging;
        $this->isGiftWrapping = $isGiftWrapping;
        $this->carrierModuleInfo = $carrierModuleInfo;
        $this->giftMessage = $giftMessage;
    }

    /**
     * hint - collection of OrderCarrierForViewing objects would be better
     *
     * @return OrderCarrierForViewing[]
     */
    public function getCarriers(): array
    {
        return $this->carriers;
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
    public function isGiftWrapping(): bool
    {
        return $this->isGiftWrapping;
    }

    /**
     * @return string|null
     */
    public function getCarrierModuleInfo(): ?string
    {
        return $this->carrierModuleInfo;
    }

    /**
     * @return string|null
     */
    public function getGiftMessage(): ?string
    {
        return $this->giftMessage;
    }

    /**
     * @param OrderCarrierForViewing $carrier
     */
    private function addCarrier(OrderCarrierForViewing $carrier): void
    {
        $this->carriers[] = $carrier;
    }
}
