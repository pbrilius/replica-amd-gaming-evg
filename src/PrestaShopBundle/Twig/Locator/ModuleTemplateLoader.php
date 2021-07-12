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

namespace PrestaShopBundle\Twig\Locator;

use Twig\Loader\FilesystemLoader;

/**
 * Loads templates from PrestaShop modules.
 */
class ModuleTemplateLoader extends FilesystemLoader
{
    /**
     * @param array $namespaces a collection of path namespaces with namespace names
     * @param array $modulePaths A path or an array of paths where to look for module templates
     */
    public function __construct(array $namespaces, array $modulePaths = [])
    {
        if (!empty($modulePaths)) {
            $this->registerNamespacesFromConfig($modulePaths, $namespaces);
        }
    }

    /**
     * Register namespaces in module and link them to the right paths.
     *
     * @param array $modulePaths
     * @param array $namespaces
     */
    private function registerNamespacesFromConfig(array $modulePaths, array $namespaces)
    {
        foreach ($namespaces as $namespace => $namespacePath) {
            $templatePaths = [];

            foreach ($modulePaths as $path) {
                if (is_dir($dir = $path . '/views/PrestaShop/' . $namespacePath)) {
                    $templatePaths[] = $dir;
                }
            }
            $this->setPaths($templatePaths, $namespace);
        }
    }
}
