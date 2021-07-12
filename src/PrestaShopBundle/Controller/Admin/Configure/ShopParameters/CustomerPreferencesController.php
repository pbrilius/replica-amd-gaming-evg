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

namespace PrestaShopBundle\Controller\Admin\Configure\ShopParameters;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use PrestaShopBundle\Security\Annotation\AdminSecurity;
use PrestaShopBundle\Security\Annotation\DemoRestricted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller responsible of "Configure > Shop Parameters > Customer Settings" page.
 */
class CustomerPreferencesController extends FrameworkBundleAdminController
{
    /**
     * Show customer preferences page.
     *
     * @Template("@PrestaShop/Admin/Configure/ShopParameters/customer_preferences.html.twig")
     * @AdminSecurity("is_granted('read', request.get('_legacy_controller'))", message="Access denied.")
     *
     * @param Request $request
     *
     * @return array Template parameters
     */
    public function indexAction(Request $request)
    {
        $legacyController = $request->attributes->get('_legacy_controller');

        $form = $this->get('prestashop.admin.customer_preferences.form_handler')->getForm();

        return [
            'layoutTitle' => $this->trans('Customers', 'Admin.Navigation.Menu'),
            'requireAddonsSearch' => true,
            'enableSidebar' => true,
            'help_link' => $this->generateSidebarLink($legacyController),
            'form' => $form->createView(),
        ];
    }

    /**
     * Process the Customer Preferences configuration form.
     *
     * @AdminSecurity("is_granted(['update', 'create','delete'], request.get('_legacy_controller'))", message="You do not have permission to update this.", redirectRoute="admin_customer_preferences")
     * @DemoRestricted(redirectRoute="admin_customer_preferences")
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function processAction(Request $request)
    {
        $formHandler = $this->get('prestashop.admin.customer_preferences.form_handler');

        $form = $formHandler->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data = $form->getData();

            if ($errors = $formHandler->save($data)) {
                $this->flashErrors($errors);

                return $this->redirectToRoute('admin_customer_preferences');
            }

            $this->addFlash('success', $this->trans('Update successful', 'Admin.Notifications.Success'));
        }

        return $this->redirectToRoute('admin_customer_preferences');
    }
}
