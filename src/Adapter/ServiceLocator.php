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

namespace PrestaShop\PrestaShop\Adapter;

use PrestaShop\PrestaShop\Core\Foundation\IoC\Container;

/**
 * @internal
 *
 * To be removed in 1.7.1.
 */
class ServiceLocator
{
    /**
     * Set a service container Instance.
     *
     * @var Container
     */
    private static $service_container;

    public static function setServiceContainerInstance(Container $container)
    {
        self::$service_container = $container;
    }

    /**
     * Get a service depending on its given $serviceName.
     *
     * @param $serviceName
     *
     * @return mixed|object
     *
     * @throws CoreException
     */
    public static function get($serviceName)
    {
        if (empty(self::$service_container) || null === self::$service_container) {
            throw new CoreException('Service container is not set.');
        }

        return self::$service_container->make($serviceName);
    }
}
