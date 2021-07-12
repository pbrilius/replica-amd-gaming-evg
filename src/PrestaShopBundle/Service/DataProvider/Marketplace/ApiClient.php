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

namespace PrestaShopBundle\Service\DataProvider\Marketplace;

use GuzzleHttp\Client;

class ApiClient
{
    private $addonsApiClient;
    private $queryParameters = [
        'format' => 'json',
    ];
    private $defaultQueryParameters;

    /**
     * @var \PrestaShop\PrestaShop\Adapter\Tools
     */
    private $toolsAdapter;

    public function __construct(
        Client $addonsApiClient,
        $locale,
        $isoCode,
        $toolsAdapter,
        $domain,
        $shopVersion
    ) {
        $this->addonsApiClient = $addonsApiClient;
        $this->toolsAdapter = $toolsAdapter;

        list($isoLang) = explode('-', $locale);

        $this->setIsoLang($isoLang)
            ->setIsoCode($isoCode)
            ->setVersion($shopVersion)
            ->setShopUrl($domain);
        $this->defaultQueryParameters = $this->queryParameters;
    }

    public function setSslVerification($verifySsl)
    {
        $this->toolsAdapter->refreshCaCertFile();
        $this->addonsApiClient->setDefaultOption('verify', $verifySsl);
    }

    /**
     * @param Client $client
     *
     * @return $this
     */
    public function setClient(Client $client)
    {
        $this->addonsApiClient = $client;

        return $this;
    }

    /**
     * In case you reuse the Client, you may want to clean the previous parameters.
     */
    public function reset()
    {
        $this->queryParameters = $this->defaultQueryParameters;
    }

    /**
     * Check Addons client account credentials.
     *
     * @return object
     */
    public function getCheckCustomer()
    {
        $response = $this->setMethod('check_customer')
            ->getResponse();

        return json_decode($response);
    }

    public function getNativesModules()
    {
        $response = $this->setMethod('listing')
            ->setAction('native')
            ->getResponse();

        $responseArray = json_decode($response);

        return isset($responseArray->modules) ? $responseArray->modules : [];
    }

    public function getPreInstalledModules()
    {
        $response = $this->setMethod('listing')
            ->setAction('install-modules')
            ->getResponse();
        $responseDecoded = json_decode($response);

        return isset($responseDecoded->modules) ? $responseDecoded->modules : [];
    }

    public function getMustHaveModules()
    {
        $response = $this->setMethod('listing')
            ->setAction('must-have')
            ->getResponse();

        $responseArray = json_decode($response);

        return isset($responseArray->modules) ? $responseArray->modules : [];
    }

    /**
     * Prepare and call API for PrestaTrust integrity and property module details.
     *
     * @param string $hash Hash of module files
     * @param string $sc_address Smart contract (Module licence)
     *
     * @return object List of checks made and their results
     */
    public function getPrestaTrustCheck($hash, $sc_address)
    {
        $this->queryParameters['module_hash'] = $hash;
        $this->queryParameters['sc_address'] = $sc_address;

        $response = $this->setMethod('trust')
            ->getResponse();

        return json_decode($response);
    }

    public function getServices()
    {
        $response = $this->setMethod('listing')
            ->setAction('service')
            ->getResponse();

        $responseArray = json_decode($response);

        return isset($responseArray->services) ? $responseArray->services : [];
    }

    public function getCategories()
    {
        $response = $this->setMethod('listing')
            ->setAction('categories')
            ->getResponse();

        $responseArray = json_decode($response);

        return isset($responseArray->module) ? $responseArray->module : [];
    }

    public function getModule($moduleId)
    {
        $response = $this->setMethod('listing')
            ->setAction('module')
            ->setModuleId($moduleId)
            ->getResponse();

        $responseArray = json_decode($response);

        if (!empty($responseArray->modules)) {
            return $responseArray->modules[0];
        }
    }

    /**
     * Call API for module ZIP content (= download).
     *
     * @param int $moduleId
     *
     * @return string binary content (zip format)
     */
    public function getModuleZip($moduleId)
    {
        return $this->setMethod('module')
            ->setModuleId($moduleId)
            ->getPostResponse();
    }

    public function getCustomerModules($userMail, $password)
    {
        $response = $this->setMethod('listing')
            ->setAction('customer')
            ->setUserMail($userMail)
            ->setPassword($password)
            ->getPostResponse();

        $responseArray = json_decode($response);

        if (!empty($responseArray->modules)) {
            return $responseArray->modules;
        }

        return [];
    }

    /**
     * Get list of themes bought by customer.
     *
     * @return object
     */
    public function getCustomerThemes()
    {
        $response = $this->setMethod('listing')
            ->setAction('customer-themes')
            ->getPostResponse();

        $responseDecoded = json_decode($response);

        if (!empty($responseDecoded->themes)) {
            return $responseDecoded->themes;
        }

        return [];
    }

    public function getResponse()
    {
        return (string) $this->addonsApiClient
            ->get(
                null,
                ['query' => $this->queryParameters,
                ]
            )->getBody();
    }

    public function getPostResponse()
    {
        return (string) $this->addonsApiClient
            ->post(
                null,
                ['query' => $this->queryParameters,
                ]
            )->getBody();
    }

    /*
     * REQUEST PARAMETER SETTERS.
     * All parameters will have the same label as their function name.
     */

    public function setMethod($method)
    {
        $this->queryParameters['method'] = $method;

        return $this;
    }

    public function setAction($action)
    {
        $this->queryParameters['action'] = $action;

        return $this;
    }

    public function setIsoLang($isoLang)
    {
        $this->queryParameters['iso_lang'] = $isoLang;

        return $this;
    }

    public function setIsoCode($isoCode)
    {
        $this->queryParameters['iso_code'] = $isoCode;

        return $this;
    }

    public function setVersion($version)
    {
        $this->queryParameters['version'] = $version;

        return $this;
    }

    public function setModuleId($moduleId)
    {
        $this->queryParameters['id_module'] = $moduleId;

        return $this;
    }

    public function setModuleKey($moduleKey)
    {
        $this->queryParameters['module_key'] = $moduleKey;

        return $this;
    }

    public function setModuleName($moduleName)
    {
        $this->queryParameters['module_name'] = $moduleName;

        return $this;
    }

    public function setShopUrl($shop_url)
    {
        $this->queryParameters['shop_url'] = $shop_url;

        return $this;
    }

    public function setUserMail($userMail)
    {
        $this->queryParameters['username'] = $userMail;

        return $this;
    }

    public function setPassword($password)
    {
        $this->queryParameters['password'] = $password;

        return $this;
    }

    /*
     * END OF REQUEST PARAMETER SETTERS.
     */
}
