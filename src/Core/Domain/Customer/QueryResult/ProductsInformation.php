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

namespace PrestaShop\PrestaShop\Core\Domain\Customer\QueryResult;

/**
 * Class CustomerProductsInformation holds information about products that customers has bought and viewed.
 */
class ProductsInformation
{
    /**
     * @var BoughtProductInformation[]
     */
    private $boughtProductsInformation;

    /**
     * @var ViewedProductInformation[]
     */
    private $viewedProductsInformation;

    /**
     * @param BoughtProductInformation[] $boughtProductsInformation
     * @param ViewedProductInformation[] $viewedProductsInformation
     */
    public function __construct(array $boughtProductsInformation, array $viewedProductsInformation)
    {
        $this->boughtProductsInformation = $boughtProductsInformation;
        $this->viewedProductsInformation = $viewedProductsInformation;
    }

    /**
     * @return BoughtProductInformation[]
     */
    public function getBoughtProductsInformation()
    {
        return $this->boughtProductsInformation;
    }

    /**
     * @return ViewedProductInformation[]
     */
    public function getViewedProductsInformation()
    {
        return $this->viewedProductsInformation;
    }
}
