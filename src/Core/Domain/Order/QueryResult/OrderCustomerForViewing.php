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

namespace PrestaShop\PrestaShop\Core\Domain\Order\QueryResult;

use DateTimeImmutable;

class OrderCustomerForViewing
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string Gender name
     */
    private $lastName;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $email;

    /**
     * @var DateTimeImmutable
     */
    private $accountRegistrationDate;

    /**
     * @var string Formatted price with currency
     */
    private $totalSpentSinceRegistration;

    /**
     * @var int
     */
    private $validOrdersPlaced;

    /**
     * @var string|null
     */
    private $privateNote;

    /**
     * @var bool
     */
    private $isGuest;

    /**
     * @var string
     */
    private $ape;

    /**
     * @var string
     */
    private $siret;

    /**
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $gender
     * @param string $email
     * @param DateTimeImmutable $accountRegistrationDate
     * @param string $totalSpentSinceRegistration
     * @param int $validOrdersPlaced
     * @param string|null $privateNote
     * @param bool $isGuest
     * @param string $ape
     * @param string $siret
     */
    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $gender,
        string $email,
        DateTimeImmutable $accountRegistrationDate,
        string $totalSpentSinceRegistration,
        int $validOrdersPlaced,
        ?string $privateNote,
        bool $isGuest,
        string $ape = '',
        string $siret = ''
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->gender = $gender;
        $this->email = $email;
        $this->accountRegistrationDate = $accountRegistrationDate;
        $this->totalSpentSinceRegistration = $totalSpentSinceRegistration;
        $this->validOrdersPlaced = $validOrdersPlaced;
        $this->privateNote = $privateNote;
        $this->isGuest = $isGuest;
        $this->ape = $ape;
        $this->siret = $siret;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getAccountRegistrationDate(): DateTimeImmutable
    {
        return $this->accountRegistrationDate;
    }

    /**
     * @return string
     */
    public function getTotalSpentSinceRegistration(): string
    {
        return $this->totalSpentSinceRegistration;
    }

    /**
     * @return int
     */
    public function getValidOrdersPlaced(): int
    {
        return $this->validOrdersPlaced;
    }

    /**
     * @return string|null
     */
    public function getPrivateNote(): ?string
    {
        return $this->privateNote;
    }

    /**
     * @return bool
     */
    public function isGuest(): bool
    {
        return $this->isGuest;
    }

    /**
     * @return string
     */
    public function getApe(): string
    {
        return $this->ape;
    }

    /**
     * @return string
     */
    public function getSiret(): string
    {
        return $this->siret;
    }
}
