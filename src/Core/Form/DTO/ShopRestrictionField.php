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

namespace PrestaShop\PrestaShop\Core\Form\DTO;

/**
 * Holds the field name for which the multi-store restriction checkbox has been checked or unchecked and the status if it
 * was restricted or not.
 */
class ShopRestrictionField
{
    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var bool
     */
    private $isRestrictedToContextShop;

    /**
     * @param string $fieldName
     * @param bool $isRestrictedToContextShop
     */
    public function __construct($fieldName, $isRestrictedToContextShop)
    {
        $this->fieldName = $fieldName;
        $this->isRestrictedToContextShop = $isRestrictedToContextShop;
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @return bool
     */
    public function isRestrictedToContextShop()
    {
        return $this->isRestrictedToContextShop;
    }
}
