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

namespace PrestaShop\PrestaShop\Core\Domain\Product\AttributeGroup\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Product\AttributeGroup\Exception\AttributeGroupConstraintException;

/**
 * Provides attribute group identification data
 */
final class AttributeGroupId
{
    /**
     * @var int
     */
    private $attributeGroupId;

    /**
     * @param int $attributeGroupId
     *
     * @throws AttributeGroupConstraintException
     */
    public function __construct($attributeGroupId)
    {
        $this->assertIsIntegerGreaterThanZero($attributeGroupId);
        $this->attributeGroupId = $attributeGroupId;
    }

    /**
     * @return mixed
     */
    public function getAttributeGroupId()
    {
        return $this->attributeGroupId;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->attributeGroupId;
    }

    /**
     * Validates that the value is integer and is greater than zero
     *
     * @param $value
     *
     * @throws AttributeGroupConstraintException
     */
    private function assertIsIntegerGreaterThanZero($value)
    {
        if (!is_int($value) || 0 >= $value) {
            throw new AttributeGroupConstraintException(sprintf('Invalid attribute group id "%s".', var_export($value, true)), AttributeGroupConstraintException::INVALID_ID);
        }
    }
}
