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

namespace PrestaShop\PrestaShop\Core\Domain\Language\Command;

use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CategoryConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Language\Exception\LanguageConstraintException;
use PrestaShop\PrestaShop\Core\Domain\Language\ValueObject\LanguageId;

/**
 * Enables/disables languages status
 */
class BulkToggleLanguagesStatusCommand
{
    /**
     * @var LanguageId[]
     */
    private $languageIds = [];

    /**
     * @var bool
     */
    private $expectedStatus;

    /**
     * @param int[] $languageIds
     * @param bool $expectedStatus
     */
    public function __construct(array $languageIds, $expectedStatus)
    {
        $this->assertStatusIsBool($expectedStatus);

        $this->setLanguages($languageIds);
        $this->expectedStatus = $expectedStatus;
    }

    /**
     * @return LanguageId[]
     */
    public function getLanguageIds()
    {
        return $this->languageIds;
    }

    /**
     * @return bool
     */
    public function getStatus()
    {
        return $this->expectedStatus;
    }

    /**
     * @param int[] $languageIds
     */
    private function setLanguages(array $languageIds)
    {
        if (empty($languageIds)) {
            throw new CategoryConstraintException('Languages must be provided in order to toggle their status');
        }

        foreach ($languageIds as $languageId) {
            $this->languageIds[] = new LanguageId($languageId);
        }
    }

    /**
     * @param bool $status
     *
     * @throws LanguageConstraintException
     */
    private function assertStatusIsBool($status)
    {
        if (!is_bool($status)) {
            throw new LanguageConstraintException('Invalid status provided, language status must be type of "bool"');
        }
    }
}
