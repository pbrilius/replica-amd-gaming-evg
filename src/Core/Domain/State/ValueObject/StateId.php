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

namespace PrestaShop\PrestaShop\Core\Domain\State\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\State\Exception\StateConstraintException;

/**
 * Provides state id
 */
class StateId
{
    /**
     * @var int
     */
    private $id;

    /**
     * @param int $id
     *
     * @throws StateConstraintException
     */
    public function __construct(int $id)
    {
        $this->assertPositiveInt($id);
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->id;
    }

    /**
     * @param int $value
     *
     * @throws StateConstraintException
     */
    private function assertPositiveInt(int $value)
    {
        if (0 > $value) {
            throw new StateConstraintException(sprintf('Invalid state id "%s".', var_export($value, true)), StateConstraintException::INVALID_ID);
        }
    }
}
