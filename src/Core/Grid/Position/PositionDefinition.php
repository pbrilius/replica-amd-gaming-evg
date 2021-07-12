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

namespace PrestaShop\PrestaShop\Core\Grid\Position;

/**
 * Class PositionDefinition used to define a position relationship, see
 * PositionDefinitionInterface for more details.
 */
final class PositionDefinition implements PositionDefinitionInterface
{
    /**
     * @var string
     */
    private $table;

    /**
     * @var string
     */
    private $idField;

    /**
     * @var string
     */
    private $positionField;

    /**
     * @var string|null
     */
    private $parentIdField;

    /**
     * @param string $table
     * @param string $idField
     * @param string $positionField
     * @param string|null $parentIdField
     */
    public function __construct(
        $table,
        $idField,
        $positionField,
        $parentIdField = null
    ) {
        $this->table = $table;
        $this->idField = $idField;
        $this->positionField = $positionField;
        $this->parentIdField = $parentIdField;
    }

    /**
     * {@inheritdoc}
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdField()
    {
        return $this->idField;
    }

    /**
     * {@inheritdoc}
     */
    public function getPositionField()
    {
        return $this->positionField;
    }

    /**
     * {@inheritdoc}
     */
    public function getParentIdField()
    {
        return $this->parentIdField;
    }
}
