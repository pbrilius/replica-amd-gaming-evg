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

namespace PrestaShop\PrestaShop\Core\Employee\Access;

use PrestaShop\PrestaShop\Core\Employee\EmployeeDataProviderInterface;

/**
 * Class ProfileAccessChecker checks profile access for employee.
 */
final class ProfileAccessChecker implements ProfileAccessCheckerInterface
{
    /**
     * @var EmployeeDataProviderInterface
     */
    private $employeeDataProvider;

    /**
     * @var int
     */
    private $superAdminProfileId;

    /**
     * @param EmployeeDataProviderInterface $employeeDataProvider
     * @param int $superAdminProfileId
     */
    public function __construct(
        EmployeeDataProviderInterface $employeeDataProvider,
        $superAdminProfileId
    ) {
        $this->employeeDataProvider = $employeeDataProvider;
        $this->superAdminProfileId = $superAdminProfileId;
    }

    /**
     * {@inheritdoc}
     */
    public function canEmployeeAccessProfile($employeeId, $profileId)
    {
        if ($this->employeeDataProvider->isSuperAdmin($employeeId)) {
            return true;
        }

        return $profileId !== $this->superAdminProfileId;
    }
}
