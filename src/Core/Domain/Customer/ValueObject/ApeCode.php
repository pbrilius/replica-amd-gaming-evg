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

namespace PrestaShop\PrestaShop\Core\Domain\Customer\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Customer\Exception\CustomerConstraintException;

/**
 * Every business in France is classified under an activity code
 * entitled APE - Activite Principale de l’Entreprise
 */
class ApeCode
{
    /**
     * @var string
     */
    private $code;

    /**
     * @param $code
     */
    public function __construct($code)
    {
        $this->assertIsApeCode($code);

        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->code;
    }

    private function assertIsApeCode($code)
    {
        if (is_string($code) && empty($code)) {
            return;
        }

        $isApeCode = is_string($code) && (bool) preg_match('/^\d{3,4}[a-zA-Z]{1}$/', $code);

        if (!$isApeCode) {
            throw new CustomerConstraintException(sprintf('Invalid ape code %s provided', var_export($code, true)), CustomerConstraintException::INVALID_APE_CODE);
        }
    }
}
