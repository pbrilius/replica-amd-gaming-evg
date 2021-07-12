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

namespace PrestaShop\PrestaShop\Adapter\Shop;

use PrestaShopException;
use ShopUrl;
use Validate;

/**
 * Class ShopUrlDataProvider is responsible for providing data from shop_url table.
 */
class ShopUrlDataProvider
{
    /**
     * @var int
     */
    private $contextShopId;

    /**
     * ShopUrlDataProvider constructor.
     *
     * @param int $contextShopId
     */
    public function __construct($contextShopId)
    {
        $this->contextShopId = $contextShopId;
    }

    /**
     * Gets main shop url data.
     *
     * @return ShopUrl
     *
     * @throws PrestaShopException
     */
    public function getMainShopUrl()
    {
        /** @var ShopUrl $result */
        $result = ShopUrl::getShopUrls($this->contextShopId)->where('main', '=', 1)->getFirst();

        if (!Validate::isLoadedObject($result)) {
            return new ShopUrl();
        }

        return $result;
    }

    /**
     * Checks whenever the main shop url exists for current shop context.
     *
     * @return bool
     *
     * @throws PrestaShopException
     */
    public function doesMainShopUrlExist()
    {
        $shopUrl = ShopUrl::getShopUrls($this->contextShopId)->where('main', '=', 1)->getFirst();

        return Validate::isLoadedObject($shopUrl);
    }
}
