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

abstract class ObjectModel extends ObjectModelCore
{
    public static $debug_list = array();

    public function __construct($id = null, $id_lang = null, $id_shop = null)
    {
        parent::__construct($id, $id_lang, $id_shop);

        $classname = get_class($this);
        if (!isset(self::$debug_list[$classname])) {
            self::$debug_list[$classname] = array();
        }

        $class_list = array('ObjectModel', 'ObjectModelCore', $classname, $classname.'Core');
        $backtrace = debug_backtrace();
        foreach ($backtrace as $trace_id => $row) {
            if (!isset($backtrace[$trace_id]['class']) || !in_array($backtrace[$trace_id]['class'], $class_list)) {
                break;
            }
        }
        $trace_id--;

        self::$debug_list[$classname][] = array(
            'file' => @$backtrace[$trace_id]['file'],
            'line' => @$backtrace[$trace_id]['line'],
        );
    }
}
