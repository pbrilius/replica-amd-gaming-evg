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

namespace PrestaShop\PrestaShop\Adapter\Container;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Interface ContainerBuilderExtensionInterface is used to externalize some container
 * building actions from the PrestaShop\PrestaShop\Adapter\ContainerBuilder (register
 * an extension, init some parameters).
 *
 * This builder extension system needs to be used for actions that can't be performed in a
 * CompilerPassInterface due to the compilation workflow (some actions MUST be done before
 * the compilation stars, this is where this system comes in handy).
 */
interface ContainerBuilderExtensionInterface
{
    /**
     * This method is called by the ContainerBuilder before compiling the container. This is where you
     * can add extension, compiler pass, or parameters to the container.
     *
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container);
}
