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

namespace PrestaShop\PrestaShop\Core\Module;

class HookConfigurator
{
    private $hookRepository;

    public function __construct(HookRepository $hookRepository)
    {
        $this->hookRepository = $hookRepository;
    }

    /**
     * $hooks is a hook configuration description
     * as found in theme.yml,
     * it has a format like:
     * [
     *     "someHookName" => [
     *        null,
     *        "blockstuff",
     *        "othermodule"
     *     ],
     *     "someOtherHookName" => [
     *         null,
     *         "blockmenu" => [
     *             "except_pages" => ["category", "product"]
     *         ]
     *     ]
     * ].
     */
    public function getThemeHooksConfiguration(array $hooks)
    {
        $hooks = array_filter($hooks, 'is_array');
        $uniqueModuleList = $this->getUniqueModuleToHookList($hooks);
        $currentHooks = $this->hookRepository->getDisplayHooksWithModules();

        foreach ($currentHooks as $hookName => $moduleList) {
            foreach ($moduleList as $key => $value) {
                if (in_array($value, $uniqueModuleList)) {
                    unset($currentHooks[$hookName][$key]);
                }
            }
        }

        foreach ($hooks as $hookName => $modules) {
            $firstNullValueFound = true;
            $existing = isset($currentHooks[$hookName]) ?
                $currentHooks[$hookName] :
                [];
            $currentHooks[$hookName] = [];
            foreach ($modules as $key => $module) {
                if ($module === null && $firstNullValueFound) {
                    $firstNullValueFound = false;
                    foreach ($existing as $m) {
                        $currentHooks[$hookName][] = $m;
                    }
                } elseif (is_array($module)) {
                    $currentHooks[$hookName][$key] = $module;
                } elseif ($module !== null) {
                    $currentHooks[$hookName][] = $module;
                }
            }
        }

        return $currentHooks;
    }

    public function setHooksConfiguration(array $hooks)
    {
        $this->hookRepository->persistHooksConfiguration(
            $this->getThemeHooksConfiguration($hooks)
        );

        return $this;
    }

    public function addHook($name, $title, $description)
    {
        $this->hookRepository->createHook($name, $title, $description);

        return $this;
    }

    private function getUniqueModuleToHookList(array $hooks)
    {
        $list = [];
        foreach ($hooks as $modules) {
            $list = array_merge($list, $modules);
        }

        return $list;
    }
}
