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

namespace PrestaShop\PrestaShop\Adapter\Module\Presenter;

use PrestaShop\PrestaShop\Adapter\Module\ModuleDataProvider;
use PrestaShop\PrestaShop\Adapter\Presenter\PresenterInterface;
use PrestaShop\PrestaShop\Core\Addon\Module\ModuleRepository;
use PrestaShop\PrestaShop\Core\Module\DataProvider\TabModuleListProviderInterface;

/**
 * Class PaymentModulesPresenter is responsible for presenting payment modules.
 */
class PaymentModulesPresenter
{
    /**
     * @var string It will use legacy controller name to get payment modules for controller
     */
    const PAYMENT_METHODS_CONTROLLER = 'AdminPayment';

    /**
     * @var TabModuleListProviderInterface
     */
    private $tabModuleListProvider;

    /**
     * @var ModuleDataProvider
     */
    private $moduleDataProvider;

    /**
     * @var PresenterInterface
     */
    private $modulePresenter;

    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    /**
     * @param TabModuleListProviderInterface $tabModuleListProvider
     * @param ModuleDataProvider $moduleDataProvider
     * @param PresenterInterface $modulePresenter
     * @param ModuleRepository $moduleRepository
     */
    public function __construct(
        TabModuleListProviderInterface $tabModuleListProvider,
        ModuleDataProvider $moduleDataProvider,
        PresenterInterface $modulePresenter,
        ModuleRepository $moduleRepository
    ) {
        $this->tabModuleListProvider = $tabModuleListProvider;
        $this->moduleDataProvider = $moduleDataProvider;
        $this->modulePresenter = $modulePresenter;
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Get presented payment modules.
     *
     * @return array
     */
    public function present()
    {
        $tabModuleNames = $this->tabModuleListProvider->getTabModules(self::PAYMENT_METHODS_CONTROLLER);

        $installedModules = $this->moduleRepository->getInstalledModules();
        $installedModuleNames = array_keys($installedModules);

        $paymentModulesToDisplay = [];
        foreach ($tabModuleNames as $moduleName) {
            if (!in_array($moduleName, $installedModuleNames) ||
                !$this->moduleDataProvider->can('configure', $moduleName)
            ) {
                continue;
            }

            $installedModule = $installedModules[$moduleName];
            if ($installedModule->database->get('active')) {
                $paymentModulesToDisplay[] = $this->modulePresenter->present($installedModule);
            }
        }

        return $paymentModulesToDisplay;
    }
}
