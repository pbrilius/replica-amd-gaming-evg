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

namespace PrestaShopBundle\EventListener;

use Language;
use PrestaShop\PrestaShop\Adapter\LegacyContext;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class UserLocaleListener
{
    private $prestaShopContext;

    public function __construct(LegacyContext $context)
    {
        $this->prestaShopContext = $context->getContext();
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (isset($this->prestaShopContext->employee) && $this->prestaShopContext->employee->isLoggedBack()) {
            $request = $event->getRequest();
            $locale = $this->getLocaleFromEmployee();
            $request->setDefaultLocale($locale);

            $request->setLocale($locale);
        }
    }

    private function getLocaleFromEmployee()
    {
        $employee = $this->prestaShopContext->employee;
        $employeeLanguage = new Language($employee->id_lang);

        return $employeeLanguage->locale;
    }
}
