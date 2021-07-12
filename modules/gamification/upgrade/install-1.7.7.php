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

if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_1_7_7($object)
{
    $cols = array(
        'start_day' => array('exist' => false, 'sql' => 'ALTER TABLE `'._DB_PREFIX_.'advice` ADD `start_day` INT NULL DEFAULT 0 '),
        'stop_day' => array('exist' => false, 'sql' => 'ALTER TABLE `'._DB_PREFIX_.'advice` ADD `stop_day` INT NULL DEFAULT 0 '),
        'start_date' =>  array('exist' => false, 'sql' => 'ALTER TABLE `'._DB_PREFIX_.'advice` DROP `start_date`'),
        'stop_date' =>  array('exist' => false, 'sql' => 'ALTER TABLE `'._DB_PREFIX_.'advice` DROP `stop_date`'),
    );
    
    $columns = Db::getInstance()->executeS('SHOW COLUMNS FROM `'._DB_PREFIX_.'advice` ');
    foreach ($columns as $c) {
        if (in_array($c['Field'], array_keys($cols))) {
            $cols[$c['Field']]['exist'] = true;
        }
    }
    
    foreach ($cols as $name => $co) {
        if (in_array($name, array('start_day', 'stop_day'))) {
            if (!$co['exist']) {
                Db::getInstance()->execute($co['sql']);
            }
        } elseif ($co['exist']) {
            Db::getInstance()->execute($co['sql']);
        }
    }

    return true;
}
