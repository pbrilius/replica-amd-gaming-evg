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

/**
 * @since 1.5.0
 */
class SupplyOrderHistoryCore extends ObjectModel
{
    /**
     * @var int Supply order Id
     */
    public $id_supply_order;

    /**
     * @var int Employee Id
     */
    public $id_employee;

    /**
     * @var string The first name of the employee responsible of the movement
     */
    public $employee_firstname;

    /**
     * @var string The last name of the employee responsible of the movement
     */
    public $employee_lastname;

    /**
     * @var int State of the supply order
     */
    public $id_state;

    /**
     * @var string Date
     */
    public $date_add;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'supply_order_history',
        'primary' => 'id_supply_order_history',
        'fields' => [
            'id_supply_order' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'id_employee' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'employee_firstname' => ['type' => self::TYPE_STRING, 'validate' => 'isName'],
            'employee_lastname' => ['type' => self::TYPE_STRING, 'validate' => 'isName'],
            'id_state' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'date_add' => ['type' => self::TYPE_DATE, 'validate' => 'isDate', 'required' => true],
        ],
    ];

    /**
     * @see ObjectModel::$webserviceParameters
     */
    protected $webserviceParameters = [
        'objectsNodeName' => 'supply_order_histories',
        'objectNodeName' => 'supply_order_history',
        'fields' => [
            'id_supply_order' => ['xlink_resource' => 'supply_orders'],
            'id_employee' => ['xlink_resource' => 'employees'],
            'id_state' => ['xlink_resource' => 'supply_order_states'],
        ],
    ];
}
