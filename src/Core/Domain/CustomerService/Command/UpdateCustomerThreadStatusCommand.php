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

namespace PrestaShop\PrestaShop\Core\Domain\CustomerService\Command;

use PrestaShop\PrestaShop\Core\Domain\CustomerService\ValueObject\CustomerThreadId;
use PrestaShop\PrestaShop\Core\Domain\CustomerService\ValueObject\CustomerThreadStatus;

/**
 * Updates customer thread with given status
 */
class UpdateCustomerThreadStatusCommand
{
    /**
     * @var CustomerThreadId
     */
    private $customerThreadId;

    /**
     * @var CustomerThreadStatus
     */
    private $customerThreadStatus;

    /**
     * @param int $customerThreadId
     * @param string $newCustomerThreadStatus
     */
    public function __construct($customerThreadId, $newCustomerThreadStatus)
    {
        $this->customerThreadId = new CustomerThreadId($customerThreadId);
        $this->customerThreadStatus = new CustomerThreadStatus($newCustomerThreadStatus);
    }

    /**
     * @return CustomerThreadId
     */
    public function getCustomerThreadId()
    {
        return $this->customerThreadId;
    }

    /**
     * @return CustomerThreadStatus
     */
    public function getCustomerThreadStatus()
    {
        return $this->customerThreadStatus;
    }
}
