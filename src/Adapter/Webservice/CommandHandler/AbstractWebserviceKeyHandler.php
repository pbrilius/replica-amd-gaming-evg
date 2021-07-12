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

namespace PrestaShop\PrestaShop\Adapter\Webservice\CommandHandler;

use PrestaShop\PrestaShop\Adapter\Domain\AbstractObjectModelHandler;
use Tools;
use WebserviceKey;

/**
 * Encapsulates common legacy behavior for adding/editing WebserviceKey
 *
 * @internal
 */
abstract class AbstractWebserviceKeyHandler extends AbstractObjectModelHandler
{
    /**
     * @param WebserviceKey $webserviceKey
     * @param array $permissions
     */
    protected function setPermissionsForWebserviceKey(WebserviceKey $webserviceKey, array $permissions)
    {
        Tools::generateHtaccess();

        $legacyPermissionsStructure = [];

        foreach ($permissions as $permission => $resources) {
            foreach ($resources as $resource) {
                $legacyPermissionsStructure[$resource][$permission] = 'on';
            }
        }

        WebserviceKey::setPermissionForAccount($webserviceKey->id, $legacyPermissionsStructure);
    }
}
