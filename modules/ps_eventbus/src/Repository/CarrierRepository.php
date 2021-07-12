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


namespace PrestaShop\Module\PsEventbus\Repository;

use Carrier;
use Context;
use Db;
use DbQuery;

class CarrierRepository
{
    /**
     * @var Db
     */
    private $db;

    /**
     * @var Context
     */
    private $context;

    public function __construct(Db $db, Context $context)
    {
        $this->db = $db;
        $this->context = $context;
    }

    /**
     * @param int $langId
     *
     * @return array
     */
    public function getCarriers($langId)
    {
        $carriers = Carrier::getCarriers($langId);

        $data = [];
        foreach ($carriers as $key => $carrier) {
            $carrierObj = new Carrier($carrier['id_carrier']);

            $data[$key]['collection'] = 'carriers';
            $data[$key]['id'] = $carrierObj->id;
            $data[$key]['properties'] = $carrier;

            $deliveryPriceByRanges = self::getDeliveryPriceByRange($carrierObj);
            foreach ($deliveryPriceByRanges as $deliveryPriceByRange) {
                $data[$key]['collection'] = 'carriers_details';
                $data[$key]['id'] = $deliveryPriceByRange['id_range_weight'];
                $data[$key]['properties'] = $deliveryPriceByRange;
            }
        }

        return $data;
    }

    /**
     * @param Carrier $carrierObj
     *
     * @return array|false
     */
    public function getDeliveryPriceByRange(Carrier $carrierObj)
    {
        $rangeTable = $carrierObj->getRangeTable();
        switch ($rangeTable) {
            case 'range_weight':
                return self::getCarrierByWeightRange($carrierObj, 'range_weight');
            case 'range_price':
                return self::getCarrierByPriceRange($carrierObj, 'range_price');
            default:
                return false;
        }
    }

    /**
     * @param Carrier $carrierObj
     * @param string $rangeTable
     *
     * @return array
     */
    private function getCarrierByPriceRange(
        Carrier $carrierObj,
        $rangeTable
    ) {
        $deliveryPriceByRange = Carrier::getDeliveryPriceByRanges($rangeTable, (int) $carrierObj->id);

        $filteredRanges = [];
        foreach ($deliveryPriceByRange as $range) {
            $filteredRanges[$range['id_range_price']]['id_range_price'] = $range['id_range_price'];
            $filteredRanges[$range['id_range_price']]['id_carrier'] = $range['id_carrier'];
            $filteredRanges[$range['id_range_price']]['zones'][$range['id_zone']]['id_zone'] = $range['id_zone'];
            $filteredRanges[$range['id_range_price']]['zones'][$range['id_zone']]['price'] = $range['price'];
        }

        return $filteredRanges;
    }

    /**
     * @param Carrier $carrierObj
     * @param string $rangeTable
     *
     * @return array
     */
    private function getCarrierByWeightRange(
        Carrier $carrierObj,
        $rangeTable
    ) {
        $deliveryPriceByRange = Carrier::getDeliveryPriceByRanges($rangeTable, (int) $carrierObj->id);

        $filteredRanges = [];
        foreach ($deliveryPriceByRange as $range) {
            $filteredRanges[$range['id_range_weight']]['id_range_weight'] = $range['id_range_weight'];
            $filteredRanges[$range['id_range_weight']]['id_carrier'] = $range['id_carrier'];
            $filteredRanges[$range['id_range_weight']]['zones'][$range['id_zone']]['id_zone'] = $range['id_zone'];
            $filteredRanges[$range['id_range_weight']]['zones'][$range['id_zone']]['price'] = $range['price'];
        }

        return $filteredRanges;
    }

    /**
     * @param string $type
     * @param string $langIso
     *
     * @return array|bool|\mysqli_result|\PDOStatement|resource|null
     *
     * @throws \PrestaShopDatabaseException
     */
    public function getShippingIncremental($type, $langIso)
    {
        $query = new DbQuery();
        $query->from(IncrementalSyncRepository::INCREMENTAL_SYNC_TABLE, 'aic');
        $query->leftJoin(EventbusSyncRepository::TYPE_SYNC_TABLE_NAME, 'ts', 'ts.type = aic.type');
        $query->where('aic.type = "' . (string) $type . '"');
        $query->where('ts.id_shop = ' . (string) $this->context->shop->id);
        $query->where('ts.lang_iso = "' . (string) $langIso . '"');

        return $this->db->executeS($query);
    }
}
