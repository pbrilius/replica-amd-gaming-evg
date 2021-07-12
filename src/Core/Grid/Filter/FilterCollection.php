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

namespace PrestaShop\PrestaShop\Core\Grid\Filter;

/**
 * Class FilterCollection manages filters collection for grid.
 */
final class FilterCollection implements FilterCollectionInterface
{
    /**
     * @var FilterInterface[]
     */
    private $filters = [];

    /**
     * {@inheritdoc}
     */
    public function add(FilterInterface $filter)
    {
        $this->filters[$filter->getName()] = $filter;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($filterName)
    {
        if (isset($this->filters[$filterName])) {
            unset($this->filters[$filterName]);
        }

        return $this;
    }

    /**
     * @param string $filterName
     *
     * @return FilterInterface|null return null if no filter with given filter name
     */
    public function get($filterName)
    {
        if (isset($this->filters[$filterName])) {
            return $this->filters[$filterName];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->filters;
    }
}
