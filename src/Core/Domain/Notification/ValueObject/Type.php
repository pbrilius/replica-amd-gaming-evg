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

namespace PrestaShop\PrestaShop\Core\Domain\Notification\ValueObject;

use PrestaShop\PrestaShop\Core\Domain\Notification\Exception\NotificationException;

/**
 * Notifications types
 */
class Type
{
    const ORDER = 'order';

    const CUSTOMER = 'customer';

    const CUSTOMER_MESSAGE = 'customer_message';

    /**
     * @var string
     */
    private $type;

    /**
     * @param string $type
     *
     * @throws NotificationException
     */
    public function __construct(string $type)
    {
        $this->assertIsValidType($type);

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @throws NotificationException
     */
    private function assertIsValidType(string $type)
    {
        $allowedTypes = [self::ORDER, self::CUSTOMER, self::CUSTOMER_MESSAGE];
        if (!in_array($type, $allowedTypes)) {
            throw new NotificationException(sprintf('Type %s is invalid. Supported types are: %s', var_export($type, true), implode(', ', $allowedTypes)));
        }
    }
}
