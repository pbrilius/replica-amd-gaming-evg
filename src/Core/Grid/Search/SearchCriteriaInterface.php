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
 * Interface SearchCriteriaInterface.
 */
interface SearchCriteriaInterface
{
    /**
     * @return string|null Return order by or null to disable ordering
     */
    public function getOrderBy();

    /**
     * @return string|null Return order by or null to disable ordering
     */
    public function getOrderWay();

    /**
     * @return int|null Return offset or null to disable offset
     */
    public function getOffset();

    /**
     * @return int|null Return limit or null to disable limiting
     */
    public function getLimit();

    /**
     * @return array Return filters
     */
    public function getFilters();
}
