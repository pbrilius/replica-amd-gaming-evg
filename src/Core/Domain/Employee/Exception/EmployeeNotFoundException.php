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

namespace PrestaShop\PrestaShop\Core\Domain\Employee\Exception;

use PrestaShop\PrestaShop\Core\Domain\Employee\ValueObject\EmployeeId;

/**
 * Class EmployeeNotFoundException is thrown when employee cannot be found.
 */
class EmployeeNotFoundException extends EmployeeException
{
    /**
     * @var EmployeeId
     */
    private $employeeId;

    /**
     * @param EmployeeId $employeeId
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(EmployeeId $employeeId, $message = '', $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->employeeId = $employeeId;
    }

    /**
     * @return EmployeeId
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }
}
