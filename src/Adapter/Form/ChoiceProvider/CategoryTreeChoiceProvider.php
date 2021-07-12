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

namespace PrestaShop\PrestaShop\Adapter\Form\ChoiceProvider;

use PrestaShop\PrestaShop\Adapter\Category\CategoryDataProvider;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;

/**
 * Class CategoryTreeChoiceProvider provides categories as tree choices.
 */
final class CategoryTreeChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * @var CategoryDataProvider
     */
    private $categoryDataProvider;

    /**
     * @var int
     */
    private $contextShopRootCategoryId;

    /**
     * @var bool
     */
    private $enabledCategoriesOnly;

    /**
     * @param CategoryDataProvider $categoryDataProvider
     * @param int $contextShopRootCategoryId
     * @param bool $enabledCategoriesOnly
     */
    public function __construct(CategoryDataProvider $categoryDataProvider, $contextShopRootCategoryId, $enabledCategoriesOnly = false)
    {
        $this->categoryDataProvider = $categoryDataProvider;
        $this->contextShopRootCategoryId = $contextShopRootCategoryId;
        $this->enabledCategoriesOnly = $enabledCategoriesOnly;
    }

    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        $categories = $this->categoryDataProvider->getNestedCategories($this->contextShopRootCategoryId, false, $this->enabledCategoriesOnly);
        $choices = [];

        foreach ($categories as $category) {
            $choices[] = $this->buildChoiceTree($category);
        }

        return $choices;
    }

    /**
     * @param array $category
     *
     * @return array
     */
    private function buildChoiceTree(array $category)
    {
        $tree = [
            'id_category' => $category['id_category'],
            'name' => $category['name'],
        ];

        if (isset($category['children'])) {
            foreach ($category['children'] as $childCategory) {
                $tree['children'][] = $this->buildChoiceTree($childCategory);
            }
        }

        return $tree;
    }
}
