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

use PrestaShop\Module\PsEventbus\Decorator\CategoryDecorator;
use PrestaShop\Module\PsEventbus\Formatter\ArrayFormatter;
use PrestaShop\Module\PsEventbus\Repository\CategoryRepository;

class CategoryDataProvider implements PaginatedApiDataProviderInterface
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var CategoryDecorator
     */
    private $categoryDecorator;
    /**
     * @var ArrayFormatter
     */
    private $arrayFormatter;

    public function __construct(CategoryRepository $categoryRepository, CategoryDecorator $categoryDecorator, ArrayFormatter $arrayFormatter)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryDecorator = $categoryDecorator;
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
        $categories = $this->categoryRepository->getCategories($offset, $limit, $langIso);

        if (!is_array($categories)) {
            return [];
        }

        $this->categoryDecorator->decorateCategories($categories);

        return array_map(function ($category) {
            return [
                'id' => "{$category['id_category']}-{$category['iso_code']}",
                'collection' => 'categories',
                'properties' => $category,
            ];
        }, $categories);
    }

    /**
     * @param int $offset
     * @param string $langIso
     *
     * @return int
     */
    public function getRemainingObjectsCount($offset, $langIso)
    {
        return (int) $this->categoryRepository->getRemainingCategoriesCount($offset, $langIso);
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
        $categories = $this->categoryRepository->getCategoriesIncremental($limit, $langIso, $objectIds);

        if (!is_array($categories)) {
            return [];
        }

        $this->categoryDecorator->decorateCategories($categories);

        return array_map(function ($category) {
            return [
                'id' => "{$category['id_category']}-{$category['iso_code']}",
                'collection' => 'categories',
                'properties' => $category,
            ];
        }, $categories);
    }
}
