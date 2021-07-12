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

namespace PrestaShopBundle\Controller\Api\Improve\Design;

use PrestaShopBundle\Controller\Api\ApiController;
use PrestaShopBundle\Security\Annotation\AdminSecurity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PositionsController extends ApiController
{
    /**
     * Update positions.
     *
     * @AdminSecurity("is_granted(['update'], request.get('_legacy_controller'))")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function updateAction(Request $request)
    {
        $moduleId = $request->request->getInt('moduleId');
        $hookId = $request->request->getInt('hookId');
        $way = $request->request->getInt('way');
        $positions = $request->request->get('positions');
        $position = (int) is_array($positions) ? array_search($hookId . '_' . $moduleId, $positions) + 1 : null;

        $module = $this->container->get('prestashop.adapter.legacy.module')->getInstanceById($moduleId);
        if (empty($module)) {
            return $this->jsonResponse(
                [
                    'hasError' => true,
                    'errors' => ['This module cannot be loaded.'],
                ],
                $request
            );
        }

        if (!$module->updatePosition($hookId, $way, $position)) {
            return $this->jsonResponse(
                [
                    'hasError' => true,
                    'errors' => ['Cannot update module position.'],
                ],
                $request
            );
        }

        return $this->jsonResponse([], $request);
    }
}
