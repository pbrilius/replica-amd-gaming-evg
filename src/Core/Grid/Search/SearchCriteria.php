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

namespace PrestaShop\PrestaShop\Core\Grid\Search;

/**
 * Class SearchCriteria stores search criteria for grid data.
 */
final class SearchCriteria implements SearchCriteriaInterface
{
    /**
     * @var array
     */
    private $filters;

    /**
     * @var string|null
     */
    private $orderBy;

    /**
     * @var string|null
     */
    private $orderWay;

    /**
     * @var string|null
     */
    private $offset;

    /**
     * @var string|null
     */
    private $limit;

    /**
     * @param array $filters
     * @param string|null $orderBy
     * @param string|null $orderWay
     * @param string|null $offset
     * @param string|null $limit
     */
    public function __construct(array $filters = [], $orderBy = null, $orderWay = null, $offset = null, $limit = null)
    {
        $this->filters = $filters;
        $this->orderBy = $orderBy;
        $this->orderWay = $orderWay;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderWay()
    {
        return $this->orderWay;
    }

    /**
     * {@inheritdoc}
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * {@inheritdoc}
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
