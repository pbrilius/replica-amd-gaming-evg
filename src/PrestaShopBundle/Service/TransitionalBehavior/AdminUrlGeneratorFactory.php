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

namespace PrestaShopBundle\Service\TransitionalBehavior;

use PrestaShop\PrestaShop\Adapter\Admin\UrlGenerator as LegacyUrlGenerator;
use PrestaShop\PrestaShop\Adapter\LegacyContext;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;

/**
 * Factory to return a UrlGeneratorInterface.
 * Either the base generator from Symfony (the Router class instance)
 * Either an Adapter for Admin legacy controllers.
 */
class AdminUrlGeneratorFactory
{
    /**
     * @var Router
     */
    private $router;

    /**
     * Constructor.
     *
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Gets the UrlGeneratorInterface subclass for Legacy Admin controllers.
     *
     * @param LegacyContext $legacyContext The legacy context needed by Legacy UrlGenerator
     *
     * @return UrlGeneratorInterface the UrlGenerator instance for Admin legacy controllers
     */
    public function forLegacy(LegacyContext $legacyContext)
    {
        return new LegacyUrlGenerator($legacyContext, $this->router);
    }

    /**
     * Gets the UrlGeneratorInterface subclass for Symfony routes.
     *
     * @return UrlGeneratorInterface the UrlGenerator instance for Admin Symfony routes
     */
    public function forSymfony()
    {
        return $this->router;
    }
}
