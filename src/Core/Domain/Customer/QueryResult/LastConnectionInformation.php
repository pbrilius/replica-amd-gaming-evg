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

namespace PrestaShop\PrestaShop\Core\Domain\Customer\QueryResult;

/**
 * Class LastConnectionInformation holds information about last customer connection to shop.
 */
class LastConnectionInformation
{
    /**
     * @var int
     */
    private $connectionId;

    /**
     * @var string
     */
    private $connectionDate;

    /**
     * @var int
     */
    private $pagesViewed;

    /**
     * @var string
     */
    private $totalTime;

    /**
     * @var string
     */
    private $httpReferer;

    /**
     * @var string
     */
    private $ipAddress;

    /**
     * @param int $connectionId
     * @param string $connectionDate
     * @param int $pagesViewed
     * @param string $totalTime
     * @param string $httpReferer
     * @param string $ipAddress
     */
    public function __construct(
        $connectionId,
        $connectionDate,
        $pagesViewed,
        $totalTime,
        $httpReferer,
        $ipAddress
    ) {
        $this->connectionId = $connectionId;
        $this->connectionDate = $connectionDate;
        $this->pagesViewed = $pagesViewed;
        $this->totalTime = $totalTime;
        $this->httpReferer = $httpReferer;
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return int
     */
    public function getConnectionId()
    {
        return $this->connectionId;
    }

    /**
     * @return string
     */
    public function getConnectionDate()
    {
        return $this->connectionDate;
    }

    /**
     * @return int
     */
    public function getPagesViewed()
    {
        return $this->pagesViewed;
    }

    /**
     * @return string
     */
    public function getTotalTime()
    {
        return $this->totalTime;
    }

    /**
     * @return string
     */
    public function getHttpReferer()
    {
        return $this->httpReferer;
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }
}
