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

namespace PrestaShop\PrestaShop\Adapter\Routes;

use Dispatcher;
use PrestaShopException;
use Validate;

/**
 * Class RouteValidator is responsible for validating routes.
 */
class RouteValidator
{
    /**
     * Check for a route pattern validity.
     *
     * @param string $pattern to validate
     *
     * @return bool Validity is ok or not
     */
    public function isRoutePattern($pattern)
    {
        return Validate::isRoutePattern($pattern);
    }

    /**
     * Check if a route rule contain all required keywords of default route definition.
     *
     * @param string $routeId
     * @param string $rule Rule to verify
     *
     * @return array - returns list of missing keywords
     *
     * @throws PrestaShopException
     */
    public function doesRouteContainsRequiredKeywords($routeId, $rule)
    {
        $missingKeywords = [];
        $validationResult = Dispatcher::getInstance()->validateRoute($routeId, $rule, $missingKeywords);

        return $validationResult ? [] : $missingKeywords;
    }
}
