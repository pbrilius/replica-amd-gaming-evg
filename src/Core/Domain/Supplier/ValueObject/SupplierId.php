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

namespace PrestaShop\PrestaShop\Core\Domain\Supplier\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Supplier\Exception\SupplierException;

/**
 * Class SupplierId
 */
class SupplierId
{
    /**
     * @var int
     */
    private $value;

    /**
     * @param int $supplierId
     *
     * @throws SupplierException
     */
    public function __construct($supplierId)
    {
        $this->assertIsIntegerGreaterThanZero($supplierId);
        $this->value = $supplierId;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $supplierId
     *
     * @throws SupplierException
     */
    private function assertIsIntegerGreaterThanZero($supplierId)
    {
        if (!is_int($supplierId) || 0 >= $supplierId) {
            throw new SupplierException(sprintf('Invalid Supplier id: %s', var_export($supplierId, true)));
        }
    }
}
