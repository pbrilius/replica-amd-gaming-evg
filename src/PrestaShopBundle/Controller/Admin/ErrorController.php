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

namespace PrestaShopBundle\Controller\Admin;

use PrestaShop\PrestaShop\Core\Domain\Configuration\Command\SwitchDebugModeCommand;
use PrestaShopBundle\Security\Annotation\AdminSecurity;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Manages Error pages (e.g. 500)
 */
class ErrorController extends FrameworkBundleAdminController
{
    /**
     * Enables debug mode from error page (500 for example)
     *
     * @AdminSecurity("is_granted(['update', 'create', 'delete'], 'AdminPerformance')")
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function enableDebugModeAction(Request $request)
    {
        $this->getCommandBus()->handle(new SwitchDebugModeCommand(true));

        return $this->redirect(
            $request->request->get('_redirect_url')
        );
    }
}
