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
 * Class PositionModification contains the modification for a
 * designated row.
 */
final class PositionModification implements PositionModificationInterface
{
    /**
     * @var string|int
     */
    private $id;

    /**
     * @var int
     */
    private $oldPosition;

    /**
     * @var int
     */
    private $newPosition;

    /**
     * @param string|int $id
     * @param int $oldPosition
     * @param int $newPosition
     */
    public function __construct(
        $id,
        $oldPosition,
        $newPosition
    ) {
        $this->id = $id;
        $this->oldPosition = $oldPosition;
        $this->newPosition = $newPosition;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getOldPosition()
    {
        return $this->oldPosition;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewPosition()
    {
        return $this->newPosition;
    }
}
