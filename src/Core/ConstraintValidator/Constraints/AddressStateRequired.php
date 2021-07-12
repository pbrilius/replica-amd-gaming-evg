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

namespace PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints;

use PrestaShop\PrestaShop\Core\ConstraintValidator\AddressStateRequiredValidator;
use Symfony\Component\Validator\Constraint;

/**
 * Validation constraint for address state choice by selected country value
 */
class AddressStateRequired extends Constraint
{
    public $message = 'An address located in a country containing states must have a state selected.';

    public $id_country;

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return AddressStateRequiredValidator::class;
    }

    public function getRequiredOptions()
    {
        return ['id_country'];
    }
}
