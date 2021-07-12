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

namespace PrestaShopBundle\Routing\Linter;

use Symfony\Component\Routing\Route;

/**
 * Responsible for checking route _legacy_link configuration
 */
final class LegacyLinkLinter implements RouteLinterInterface
{
    /**
     * Checks if _legacy_link is configured to route.
     * Returns true if configured, false if not.
     *
     * {@inheritdoc}
     */
    public function lint($routeName, Route $route)
    {
        if ($route->hasDefault($routeName)) {
            return true;
        }

        return false;
    }
}
