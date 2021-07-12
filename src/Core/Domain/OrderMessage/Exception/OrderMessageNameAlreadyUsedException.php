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

declare(strict_types=1);

namespace PrestaShop\PrestaShop\Core\Domain\OrderMessage\Exception;

use Exception;

/**
 * Thrown when order message's name is already used by another order message.
 */
class OrderMessageNameAlreadyUsedException extends OrderMessageException
{
    /**
     * @var int
     */
    private $langId;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name the email that's being used
     * @param int $langId
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(string $name, int $langId, string $message = '', int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->name = $name;
        $this->langId = $langId;
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
    public function getLangId(): int
    {
        return $this->langId;
    }
}
