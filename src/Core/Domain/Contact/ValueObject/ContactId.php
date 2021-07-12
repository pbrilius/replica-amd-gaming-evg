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

namespace PrestaShop\PrestaShop\Core\Domain\Contact\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Contact\Exception\ContactException;

/**
 * Class ContactId
 */
class ContactId
{
    /**
     * @var int
     */
    private $contactId;

    /**
     * @param int $contactId
     *
     * @throws ContactException
     */
    public function __construct($contactId)
    {
        $this->assertIsIntegerOrMoreThanZero($contactId);

        $this->contactId = $contactId;
    }

    /**
     * @param $contactId
     *
     * @throws ContactException
     */
    private function assertIsIntegerOrMoreThanZero($contactId)
    {
        if (!is_int($contactId) || 0 >= $contactId) {
            throw new ContactException(sprintf('Invalid Contact id: %s', var_export($contactId, true)));
        }
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->contactId;
    }
}
