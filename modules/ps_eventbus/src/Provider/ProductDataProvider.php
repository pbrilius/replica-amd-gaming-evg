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

use PrestaShop\Module\PsEventbus\Decorator\ProductDecorator;
use PrestaShop\Module\PsEventbus\Formatter\ArrayFormatter;
use PrestaShop\Module\PsEventbus\Repository\LanguageRepository;
use PrestaShop\Module\PsEventbus\Repository\ProductRepository;

class ProductDataProvider implements PaginatedApiDataProviderInterface
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var ProductDecorator
     */
    private $productDecorator;
    /**
     * @var LanguageRepository
     */
    private $languageRepository;
    /**
     * @var ArrayFormatter
     */
    private $arrayFormatter;

    public function __construct(
        ProductRepository $productRepository,
        ProductDecorator $productDecorator,
        LanguageRepository $languageRepository,
        ArrayFormatter $arrayFormatter
    ) {
        $this->productRepository = $productRepository;
        $this->productDecorator = $productDecorator;
        $this->languageRepository = $languageRepository;
        $this->arrayFormatter = $arrayFormatter;
    }

    /**
     * @param int $offset
     * @param int $limit
     * @param string $langIso
     *
     * @return array
     *
     * @throws \PrestaShopDatabaseException
     */
    public function getFormattedData($offset, $limit, $langIso)
    {
        $langId = $this->languageRepository->getLanguageIdByIsoCode($langIso);

        $products = $this->productRepository->getProducts($offset, $limit, $langId);

        $this->productDecorator->decorateProducts($products, $langIso, $langId);

        return array_map(function ($product) {
            return [
                'id' => $product['unique_product_id'],
                'collection' => 'products',
                'properties' => $product,
            ];
        }, $products);
    }

    /**
     * @param int $offset
     * @param string $langIso
     *
     * @return int
     *
     * @throws \PrestaShopDatabaseException
     */
    public function getRemainingObjectsCount($offset, $langIso)
    {
        $langId = $this->languageRepository->getLanguageIdByIsoCode($langIso);

        return (int) $this->productRepository->getRemainingProductsCount($offset, $langId);
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
        $langId = $this->languageRepository->getLanguageIdByIsoCode($langIso);

        $products = $this->productRepository->getProductsIncremental($limit, $langId, $objectIds);

        if (!empty($products)) {
            $this->productDecorator->decorateProducts($products, $langIso, $langId);
        } else {
            return [];
        }

        return array_map(function ($product) {
            return [
                'id' => $product['unique_product_id'],
                'collection' => 'products',
                'properties' => $product,
            ];
        }, $products);
    }
}
