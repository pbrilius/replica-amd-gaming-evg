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

namespace PrestaShop\PrestaShop\Core\Product\Search;

use Symfony\Component\Translation\TranslatorInterface;

/**
 * This class provide the list of default Sort Orders.
 */
final class SortOrdersCollection
{
    /**
     * @var TranslatorInterface the translator
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return array
     *
     * @throws \Exception
     */
    public function getDefaults()
    {
        return [
            (new SortOrder('product', 'position', 'desc'))->setLabel(
                $this->translator->trans('Relevance', [], 'Shop.Theme.Catalog')
            ),
            (new SortOrder('product', 'name', 'asc'))->setLabel(
                $this->translator->trans('Name, A to Z', [], 'Shop.Theme.Catalog')
            ),
            (new SortOrder('product', 'name', 'desc'))->setLabel(
                $this->translator->trans('Name, Z to A', [], 'Shop.Theme.Catalog')
            ),
            (new SortOrder('product', 'price', 'asc'))->setLabel(
                $this->translator->trans('Price, low to high', [], 'Shop.Theme.Catalog')
            ),
            (new SortOrder('product', 'price', 'desc'))->setLabel(
                $this->translator->trans('Price, high to low', [], 'Shop.Theme.Catalog')
            ),
        ];
    }
}
