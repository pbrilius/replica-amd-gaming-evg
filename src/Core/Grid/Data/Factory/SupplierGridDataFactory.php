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

namespace PrestaShop\PrestaShop\Core\Grid\Data\Factory;

use PrestaShop\PrestaShop\Core\Grid\Data\GridData;
use PrestaShop\PrestaShop\Core\Grid\Record\RecordCollection;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;
use PrestaShop\PrestaShop\Core\Image\ImageProviderInterface;

/**
 * Class SupplierGridDataFactory gets data for supplier grid.
 */
final class SupplierGridDataFactory implements GridDataFactoryInterface
{
    /**
     * @var GridDataFactoryInterface
     */
    private $supplierDataFactory;

    /**
     * @var ImageProviderInterface
     */
    private $supplierLogoImageProvider;

    /**
     * @param GridDataFactoryInterface $supplierDataFactory
     * @param ImageProviderInterface $supplierLogoImageProvider
     */
    public function __construct(
        GridDataFactoryInterface $supplierDataFactory,
        ImageProviderInterface $supplierLogoImageProvider
    ) {
        $this->supplierDataFactory = $supplierDataFactory;
        $this->supplierLogoImageProvider = $supplierLogoImageProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(SearchCriteriaInterface $searchCriteria)
    {
        $supplierData = $this->supplierDataFactory->getData($searchCriteria);

        $modifiedRecords = $this->applyModification(
            $supplierData->getRecords()->all()
        );

        return new GridData(
            new RecordCollection($modifiedRecords),
            $supplierData->getRecordsTotal(),
            $supplierData->getQuery()
        );
    }

    /**
     * @param array $suppliers
     *
     * @return array
     */
    private function applyModification(array $suppliers)
    {
        foreach ($suppliers as $i => $supplier) {
            $suppliers[$i]['logo'] = $this->supplierLogoImageProvider->getPath($supplier['id_supplier']);
        }

        return $suppliers;
    }
}
