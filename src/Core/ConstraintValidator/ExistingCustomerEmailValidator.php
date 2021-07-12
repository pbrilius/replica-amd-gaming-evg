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

namespace PrestaShop\PrestaShop\Core\ConstraintValidator;

use PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints\ExistingCustomerEmail;
use PrestaShop\PrestaShop\Core\Customer\CustomerDataSourceInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Validator for checking if customer with given email exists in current shop context
 */
final class ExistingCustomerEmailValidator extends ConstraintValidator
{
    /**
     * @var CustomerDataSourceInterface
     */
    private $customerDataSource;

    /**
     * @param CustomerDataSourceInterface $customerDataSource
     */
    public function __construct(CustomerDataSourceInterface $customerDataSource)
    {
        $this->customerDataSource = $customerDataSource;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ExistingCustomerEmail) {
            throw new UnexpectedTypeException($constraint, ExistingCustomerEmail::class);
        }

        if (!$this->customerDataSource->hasCustomerWithEmail($value)) {
            $this->context->buildViolation($constraint->message)
                ->setTranslationDomain('Admin.Orderscustomers.Notification')
                ->addViolation()
            ;
        }
    }
}
