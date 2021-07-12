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


namespace PrestaShop\Module\PsEventbus\Provider;

use PrestaShop\Module\PsEventbus\Formatter\ArrayFormatter;
use PrestaShop\Module\PsEventbus\Repository\CartProductRepository;
use PrestaShop\Module\PsEventbus\Repository\CartRepository;

class CartDataProvider implements PaginatedApiDataProviderInterface
{
    /**
     * @var CartRepository
     */
    private $cartRepository;
    /**
     * @var CartProductRepository
     */
    private $cartProductRepository;
    /**
     * @var ArrayFormatter
     */
    private $arrayFormatter;

    /**
     * @param CartRepository $cartRepository
     * @param CartProductRepository $cartProductRepository
     * @param ArrayFormatter $arrayFormatter
     */
    public function __construct(
        CartRepository $cartRepository,
        CartProductRepository $cartProductRepository,
        ArrayFormatter $arrayFormatter
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartProductRepository = $cartProductRepository;
        $this->arrayFormatter = $arrayFormatter;
    }

    public function getFormattedData($offset, $limit, $langIso)
    {
        $carts = $this->cartRepository->getCarts($offset, $limit);

        if (!is_array($carts)) {
            return [];
        }

        $cartProducts = $this->getCartProducts($carts);

        $this->castCartValues($carts);

        $carts = array_map(function ($cart) {
            return [
                'id' => $cart['id_cart'],
                'collection' => 'carts',
                'properties' => $cart,
            ];
        }, $carts);

        return array_merge($carts, $cartProducts);
    }

    /**
     * @param int $offset
     * @param string $langIso
     *
     * @return int
     */
    public function getRemainingObjectsCount($offset, $langIso)
    {
        return (int) $this->cartRepository->getRemainingCartsCount($offset);
    }

    /**
     * @param array $carts
     *
     * @return void
     */
    private function castCartValues(array &$carts)
    {
        foreach ($carts as &$cart) {
            $cart['id_cart'] = (string) $cart['id_cart'];
        }
    }

    /**
     * @param array $cartProducts
     *
     * @return void
     */
    private function castCartProductValues(array &$cartProducts)
    {
        foreach ($cartProducts as &$cartProduct) {
            $cartProduct['id_cart_product'] = (string) "{$cartProduct['id_cart']}-{$cartProduct['id_product']}-{$cartProduct['id_product_attribute']}";
            $cartProduct['id_cart'] = (string) $cartProduct['id_cart'];
            $cartProduct['id_product'] = (string) $cartProduct['id_product'];
            $cartProduct['id_product_attribute'] = (string) $cartProduct['id_product_attribute'];
            $cartProduct['quantity'] = (int) $cartProduct['quantity'];
        }
    }

    /**
     * @param int $limit
     * @param string $langIso
     * @param array $objectIds
     *
     * @return array
     *
     * @throws \PrestaShopDatabaseException
     */
    public function getFormattedDataIncremental($limit, $langIso, $objectIds)
    {
        $carts = $this->cartRepository->getCartsIncremental($limit, $objectIds);

        if (!is_array($carts) || empty($carts)) {
            return [];
        }

        $cartProducts = $this->getCartProducts($carts);

        $this->castCartValues($carts);

        $carts = array_map(function ($cart) {
            return [
                'id' => $cart['id_cart'],
                'collection' => 'carts',
                'properties' => $cart,
            ];
        }, $carts);

        return array_merge($carts, $cartProducts);
    }

    /**
     * @param array $carts
     *
     * @return array
     *
     * @throws \PrestaShopDatabaseException
     */
    private function getCartProducts(array $carts)
    {
        $cartIds = array_map(function ($cart) {
            return (string) $cart['id_cart'];
        }, $carts);

        $cartProducts = $this->cartProductRepository->getCartProducts($cartIds);

        if (!is_array($cartProducts) || empty($cartProducts)) {
            return [];
        }

        $this->castCartProductValues($cartProducts);

        if (is_array($cartProducts)) {
            return array_map(function ($cartProduct) {
                return [
                    'id' => "{$cartProduct['id_cart']}-{$cartProduct['id_product']}-{$cartProduct['id_product_attribute']}",
                    'collection' => 'cart_products',
                    'properties' => $cartProduct,
                ];
            }, $cartProducts);
        }

        return [];
    }
}
