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

namespace PrestaShopBundle\Routing\Converter;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class RouterProvider.
 */
class RouterProvider extends AbstractLegacyRouteProvider
{
    /**
     * @var LegacyRoute[]
     */
    private $legacyRoutes;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * RouterProvider constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function getLegacyRoutes()
    {
        if (null == $this->legacyRoutes) {
            $this->legacyRoutes = $this->buildLegacyRoutes();
        }

        return $this->legacyRoutes;
    }

    /**
     * @return array
     */
    private function buildLegacyRoutes()
    {
        $legacyRoutes = [];
        /** @var Route $route */
        foreach ($this->router->getRouteCollection() as $routeName => $route) {
            $routeDefaults = $route->getDefaults();
            if (empty($routeDefaults['_legacy_link'])) {
                continue;
            }

            $legacyRoutes[$routeName] = LegacyRoute::buildLegacyRoute($routeName, $routeDefaults);
        }

        return $legacyRoutes;
    }
}
