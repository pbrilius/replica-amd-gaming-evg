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


namespace PrestaShop\Module\PsEventbus\Service;

use PrestaShop\Module\PsEventbus\Api\EventBusSyncClient;
use PrestaShop\Module\PsEventbus\Exception\EnvVarException;
use PrestaShop\Module\PsEventbus\Repository\EventbusSyncRepository;
use PrestaShopDatabaseException;

class ApiAuthorizationService
{
    /**
     * @var EventbusSyncRepository
     */
    private $eventbusSyncStateRepository;
    /**
     * @var EventBusSyncClient
     */
    private $eventBusSyncClient;

    public function __construct(
        EventbusSyncRepository $eventbusSyncStateRepository,
        EventBusSyncClient $eventBusSyncClient
    ) {
        $this->eventbusSyncStateRepository = $eventbusSyncStateRepository;
        $this->eventBusSyncClient = $eventBusSyncClient;
    }

    /**
     * Authorizes if the call to endpoint is legit and creates sync state if needed
     *
     * @param string $jobId
     *
     * @return array|bool
     *
     * @throws PrestaShopDatabaseException|EnvVarException
     */
    public function authorizeCall($jobId)
    {
        $job = $this->eventbusSyncStateRepository->findJobById($jobId);

        if ($job) {
            return true;
        }

        $jobValidationResponse = $this->eventBusSyncClient->validateJobId($jobId);

        if (is_array($jobValidationResponse) && (int) $jobValidationResponse['httpCode'] === 201) {
            return $this->eventbusSyncStateRepository->insertJob($jobId, date(DATE_ATOM));
        }

        return $jobValidationResponse;
    }
}
