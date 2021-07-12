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
 * Used to delay loading of external classes with smarty->register_plugin.
 */
class SmartyLazyRegister
{
    protected $registry = [];
    protected static $instances = [];

    /**
     * Register a function or method to be dynamically called later.
     *
     * @param string|array $params function name or array(object name, method name)
     */
    public function register($params)
    {
        if (is_array($params)) {
            $this->registry[$params[1]] = $params;
        } else {
            $this->registry[$params] = $params;
        }
    }

    public function isRegistered($params)
    {
        if (is_array($params)) {
            $params = $params[1];
        }

        return isset($this->registry[$params]);
    }

    /**
     * Dynamically call static function or method.
     *
     * @param string $name function name
     * @param mixed $arguments function argument
     *
     * @return mixed function return
     */
    public function __call($name, $arguments)
    {
        $item = $this->registry[$name];

        // case 1: call to static method - case 2 : call to static function
        if (is_array($item[1])) {
            return call_user_func_array($item[1] . '::' . $item[0], [$arguments[0], &$arguments[1]]);
        } else {
            $args = [];

            foreach ($arguments as $a => $argument) {
                if ($a == 0) {
                    $args[] = $arguments[0];
                } else {
                    $args[] = &$arguments[$a];
                }
            }

            return call_user_func_array($item, $args);
        }
    }

    public static function getInstance($smarty)
    {
        $hash = spl_object_hash($smarty);

        if (!isset(self::$instances[$hash])) {
            self::$instances[$hash] = new self();
        }

        return self::$instances[$hash];
    }
}
