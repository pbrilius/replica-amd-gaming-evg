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

namespace PrestaShop\PrestaShop\Adapter\Module\PrestaTrust;

use PrestaShopBundle\Event\ModuleZipManagementEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * This class subscribes to the events module installation / uninstallation
 * in order to install or remove its tabs as well.
 */
class ModuleEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var PrestaTrustChecker
     */
    private $checker;

    /**
     * These events can be enabled/disabled via the config file.
     *
     * @var bool
     */
    private $enabled;

    public function __construct(PrestaTrustChecker $checker)
    {
        $this->checker = $checker;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ModuleZipManagementEvent::DOWNLOAD => 'onNewModule',
        ];
    }

    /**
     * Event executed on module download (coming from the marketplace or the employee disk)
     * If the feature is enabled in the project configuration, we will trigger our class PrestaTrustChecker to verify
     * if the module is compliant.
     *
     * @param ModuleZipManagementEvent $event
     */
    public function onNewModule(ModuleZipManagementEvent $event)
    {
        if (!$this->enabled) {
            return;
        }

        $this->checker->checkModuleZip($event->getModuleZip());
    }

    /**
     * Check if the feature is enabled.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Enable / disable the PrestaTrust feature.
     *
     * @param bool $enabled
     *
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = (bool) $enabled;

        return $this;
    }
}
