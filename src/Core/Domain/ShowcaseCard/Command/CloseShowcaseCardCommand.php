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

namespace PrestaShop\PrestaShop\Core\Domain\ShowcaseCard\Command;

use PrestaShop\PrestaShop\Core\Domain\ShowcaseCard\Exception\InvalidShowcaseCardNameException;
use PrestaShop\PrestaShop\Core\Domain\ShowcaseCard\Exception\ShowcaseCardException;
use PrestaShop\PrestaShop\Core\Domain\ShowcaseCard\ValueObject\ShowcaseCard;

/**
 * This command permanently closes a showcase card
 */
class CloseShowcaseCardCommand
{
    /**
     * @var int
     */
    private $employeeId;

    /**
     * @var ShowcaseCard
     */
    private $showcaseCard;

    /**
     * CloseShowcaseCardCommand constructor.
     *
     * @param int $employeeId
     * @param string $showcaseCardName Name of the showcase card
     *
     * @throws InvalidShowcaseCardNameException
     * @throws ShowcaseCardException
     */
    public function __construct($employeeId, $showcaseCardName)
    {
        if (!is_int($employeeId)) {
            throw new ShowcaseCardException(sprintf('Expected employee id to be an int, but was %s', gettype($employeeId)));
        }

        $this->employeeId = $employeeId;
        $this->showcaseCard = new ShowcaseCard($showcaseCardName);
    }

    /**
     * @return int
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     * @return ShowcaseCard
     */
    public function getShowcaseCard()
    {
        return $this->showcaseCard;
    }
}
