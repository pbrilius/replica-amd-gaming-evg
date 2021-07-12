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


namespace PrestaShop\Module\PsEventbus\Decorator;

class CategoryDecorator
{
    /**
     * @param array $categories
     *
     * @return void
     */
    public function decorateCategories(array &$categories)
    {
        foreach ($categories as &$category) {
            $this->castPropertyValues($category);
            $this->formatDescription($category);
        }
    }

    /**
     * @param array $category
     *
     * @return void
     */
    private function castPropertyValues(array &$category)
    {
        $category['id_category'] = (int) $category['id_category'];
        $category['id_parent'] = (int) $category['id_parent'];
    }

    /**
     * @param array $category
     *
     * @return void
     */
    private function formatDescription(array &$category)
    {
        $category['description'] = md5($category['description']);
    }
}
