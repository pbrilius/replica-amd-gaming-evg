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

namespace PrestaShop\PrestaShop\Core\Domain\Webservice\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Webservice\Exception\WebserviceConstraintException;

/**
 * Encapsulates webservice key id value
 */
class WebserviceKeyId
{
    /**
     * @var int
     */
    private $webserviceKeyId;

    /**
     * @param int $webserviceKeyId
     */
    public function __construct($webserviceKeyId)
    {
        $this->assertWebserviceKeyIdIsIntegerGreaterThanZero($webserviceKeyId);

        $this->webserviceKeyId = $webserviceKeyId;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->webserviceKeyId;
    }

    /**
     * @param int $webserviceKeyId
     */
    private function assertWebserviceKeyIdIsIntegerGreaterThanZero($webserviceKeyId)
    {
        if (!is_int($webserviceKeyId) || $webserviceKeyId <= 0) {
            throw new WebserviceConstraintException(sprintf('Webservice key id must be integer greater than 0, but %s given', var_export($webserviceKeyId, true)));
        }
    }
}
