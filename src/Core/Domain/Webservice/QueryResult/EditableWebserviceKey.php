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

namespace PrestaShop\PrestaShop\Core\Domain\Webservice\QueryResult;

use PrestaShop\PrestaShop\Core\Domain\Webservice\ValueObject\WebserviceKeyId;

/**
 * Editable data for webservice key
 */
class EditableWebserviceKey
{
    /**
     * @var WebserviceKeyId
     */
    private $webserviceKeyId;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $status;

    /**
     * @var array
     */
    private $resourcePermissions;

    /**
     * @var int[]
     */
    private $associatedShops;

    /**
     * @param WebserviceKeyId $webserviceKeyId
     * @param string $key
     * @param string $description
     * @param bool $status
     * @param array $resourcePermissions
     * @param array $associatedShops
     */
    public function __construct(
        WebserviceKeyId $webserviceKeyId,
        $key,
        $description,
        $status,
        array $resourcePermissions,
        array $associatedShops
    ) {
        $this->webserviceKeyId = $webserviceKeyId;
        $this->key = $key;
        $this->description = $description;
        $this->status = $status;
        $this->resourcePermissions = $resourcePermissions;
        $this->associatedShops = $associatedShops;
    }

    /**
     * @return WebserviceKeyId
     */
    public function getWebserviceKeyId()
    {
        return $this->webserviceKeyId;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getResourcePermissions()
    {
        return $this->resourcePermissions;
    }

    /**
     * @return int[]
     */
    public function getAssociatedShops()
    {
        return $this->associatedShops;
    }
}
