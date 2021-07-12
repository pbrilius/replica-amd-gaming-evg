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


namespace PrestaShop\Module\PsEventbus\Api;

use GuzzleHttp\Client;
use Link;
use PrestaShop\Module\PsEventbus\Exception\EnvVarException;
use PrestaShop\PsAccountsInstaller\Installer\Facade\PsAccounts;

class EventBusSyncClient extends GenericClient
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * EventBusSyncClient constructor.
     *
     * @param Link $link
     * @param PsAccounts $psAccountsService
     * @param string $baseUrl
     *
     * @throws \PrestaShop\PsAccountsInstaller\Installer\Exception\ModuleNotInstalledException
     * @throws \PrestaShop\PsAccountsInstaller\Installer\Exception\ModuleVersionException
     */
    public function __construct(Link $link, PsAccounts $psAccountsService, $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->setLink($link);
        $token = $psAccountsService->getPsAccountsService()->getOrRefreshToken();

        $client = new Client([
            'base_url' => $this->baseUrl,
            'defaults' => [
                'timeout' => $this->timeout,
                'exceptions' => $this->catchExceptions,
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer $token",
                ],
            ],
        ]);

        parent::__construct($client);
    }

    /**
     * @param string $jobId
     *
     * @return array|bool
     *
     * @throws EnvVarException
     */
    public function validateJobId($jobId)
    {
        $this->setRoute($this->baseUrl . "/job/$jobId");

        return $this->get();
    }
}
