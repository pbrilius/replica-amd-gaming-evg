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

namespace PrestaShop\PrestaShop\Core\Domain\Product\QueryResult;

/**
 * Holds data of product customization field
 */
class ProductCustomizationField
{
    const TYPE_FILE = 0;
    const TYPE_TEXT = 1;

    /**
     * @var int
     */
    private $customizationFieldId;

    /**
     * @var int
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $isRequired;

    /**
     * @param int $customizationFieldId
     * @param int $type
     * @param string $name
     * @param bool $isRequired
     */
    public function __construct(
        int $customizationFieldId,
        int $type,
        string $name,
        bool $isRequired
    ) {
        $this->customizationFieldId = $customizationFieldId;
        $this->type = $type;
        $this->name = $name;
        $this->isRequired = $isRequired;
    }

    /**
     * @return int
     */
    public function getCustomizationFieldId(): int
    {
        return $this->customizationFieldId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->isRequired;
    }
}
