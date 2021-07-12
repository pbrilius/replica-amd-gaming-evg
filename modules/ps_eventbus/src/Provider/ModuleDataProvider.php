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


namespace PrestaShop\Module\PsEventbus\Provider;

use PrestaShop\Module\PsEventbus\Repository\ModuleRepository;
use PrestaShopDatabaseException;

class ModuleDataProvider implements PaginatedApiDataProviderInterface
{
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * @param int $offset
     * @param int $limit
     * @param string $langIso
     *
     * @return array
     */
    public function getFormattedData($offset, $limit, $langIso)
    {
        try {
            $modules = $this->moduleRepository->getModules($offset, $limit);
        } catch (PrestaShopDatabaseException $e) {
            return [];
        }

        if (!is_array($modules)) {
            return [];
        }

        return array_map(function ($module) {
            $moduleId = (string) $module['module_id'];
            $module['active'] = $module['active'] == '1';

            return [
                'id' => $moduleId,
                'collection' => 'modules',
                'properties' => $module,
            ];
        }, $modules);
    }

    /**
     * @param int $offset
     * @param string $langIso
     *
     * @return int
     */
    public function getRemainingObjectsCount($offset, $langIso)
    {
        return (int) $this->moduleRepository->getRemainingModules($offset);
    }

    public function getFormattedDataIncremental($limit, $langIso, $objectIds)
    {
        return [];
    }
}
