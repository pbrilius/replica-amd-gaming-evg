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

namespace PrestaShop\PrestaShop\Core\Grid\Definition;

use PrestaShop\PrestaShop\Core\Grid\Action\Bulk\BulkActionCollectionInterface;
use PrestaShop\PrestaShop\Core\Grid\Action\GridActionCollectionInterface;
use PrestaShop\PrestaShop\Core\Grid\Column\ColumnCollectionInterface;
use PrestaShop\PrestaShop\Core\Grid\Filter\FilterCollectionInterface;

/**
 * Interface GridDefinitionInterface defines contract for grid definition.
 */
interface GridDefinitionInterface
{
    /**
     * Get unique grid identifier.
     *
     * @return string
     */
    public function getId();

    /**
     * Get grid name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get grid columns.
     *
     * @return ColumnCollectionInterface
     */
    public function getColumns();

    /**
     * @return BulkActionCollectionInterface
     */
    public function getBulkActions();

    /**
     * Get grid actions.
     *
     * @return GridActionCollectionInterface
     */
    public function getGridActions();

    /**
     * Get filters.
     *
     * @return FilterCollectionInterface
     */
    public function getFilters();
}
