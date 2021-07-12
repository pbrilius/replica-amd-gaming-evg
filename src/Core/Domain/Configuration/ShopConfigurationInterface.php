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

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Core\Domain\Configuration;

use PrestaShop\PrestaShop\Core\ConfigurationInterface;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;

interface ShopConfigurationInterface extends ConfigurationInterface
{
    /**
     * @param string $key
     * @param mixed|null $default
     * @param ShopConstraint|null $shopConstraint
     *
     * @return mixed
     */
    public function get($key, $default = null, ShopConstraint $shopConstraint = null);

    /**
     * @param string $key
     * @param mixed $value
     * @param ShopConstraint|null $shopConstraint
     *
     * @return ShopConfigurationInterface
     */
    public function set($key, $value, ShopConstraint $shopConstraint = null);

    /**
     * @param string $key
     * @param ShopConstraint|null $shopConstraint
     *
     * @return bool
     */
    public function has($key, ShopConstraint $shopConstraint = null);
}
