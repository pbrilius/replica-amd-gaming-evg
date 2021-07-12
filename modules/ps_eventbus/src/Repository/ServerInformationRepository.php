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


namespace PrestaShop\Module\PsEventbus\Repository;

use Context;
use Db;
use DbQuery;
use Exception;
use Language;
use PrestaShop\AccountsAuth\Service\PsAccountsService;
use PrestaShop\Module\PsEventbus\Formatter\ArrayFormatter;
use PrestaShop\PsAccountsInstaller\Installer\Facade\PsAccounts;
use PrestaShopDatabaseException;
use Ps_eventbus;

class ServerInformationRepository
{
    /**
     * @var CurrencyRepository
     */
    private $currencyRepository;
    /**
     * @var LanguageRepository
     */
    private $languageRepository;
    /**
     * @var ConfigurationRepository
     */
    private $configurationRepository;
    /**
     * @var Context
     */
    private $context;
    /**
     * @var Db
     */
    private $db;
    /**
     * @var ArrayFormatter
     */
    private $arrayFormatter;
    /**
     * @var ShopRepository
     */
    private $shopRepository;
    /**
     * @var PsAccountsService
     */
    private $psAccountsService;
    /**
     * @var array
     */
    private $configuration;

    public function __construct(
        Context $context,
        Db $db,
        CurrencyRepository $currencyRepository,
        LanguageRepository $languageRepository,
        ConfigurationRepository $configurationRepository,
        ShopRepository $shopRepository,
        ArrayFormatter $arrayFormatter,
        PsAccounts $psAccounts,
        array $configuration
    ) {
        $this->currencyRepository = $currencyRepository;
        $this->languageRepository = $languageRepository;
        $this->configurationRepository = $configurationRepository;
        $this->shopRepository = $shopRepository;
        $this->context = $context;
        $this->db = $db;
        $this->arrayFormatter = $arrayFormatter;
        $this->psAccountsService = $psAccounts->getPsAccountsService();
        $this->configuration = $configuration;
    }

    /**
     * @param null $langIso
     *
     * @return array
     */
    public function getServerInformation($langIso = null)
    {
        $langId = $langIso != null ? (int) Language::getIdByIso($langIso) : null;

        return [
            [
                'id' => '1',
                'collection' => 'shops',
                'properties' => [
                    'created_at' => date(DATE_ATOM),
                    'cms_version' => _PS_VERSION_,
                    'url_is_simplified' => $this->configurationRepository->get('PS_REWRITING_SETTINGS') == '1',
                    'cart_is_persistent' => $this->configurationRepository->get('PS_CART_FOLLOWING') == '1',
                    'default_language' => $this->languageRepository->getDefaultLanguageIsoCode(),
                    'languages' => implode(';', $this->languageRepository->getLanguagesIsoCodes()),
                    'default_currency' => $this->currencyRepository->getDefaultCurrencyIsoCode(),
                    'currencies' => implode(';', $this->currencyRepository->getCurrenciesIsoCodes()),
                    'weight_unit' => $this->configurationRepository->get('PS_WEIGHT_UNIT'),
                    'timezone' => $this->configurationRepository->get('PS_TIMEZONE'),
                    'is_order_return_enabled' => $this->configurationRepository->get('PS_ORDER_RETURN') == '1',
                    'order_return_nb_days' => (int) $this->configurationRepository->get('PS_ORDER_RETURN_NB_DAYS'),
                    'php_version' => phpversion(),
                    'http_server' => isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '',
                    'url' => $this->context->link->getPageLink('index', null, $langId),
                    'ssl' => $this->configurationRepository->get('PS_SSL_ENABLED') == '1',
                    'multi_shop_count' => $this->shopRepository->getMultiShopCount(),
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getHealthCheckData()
    {
        $tokenValid = true;
        $allTablesInstalled = true;
        $phpVersion = '';

        try {
            $token = $this->psAccountsService->getOrRefreshToken();

            if (!$token) {
                $tokenValid = false;
            }
        } catch (Exception $e) {
            $tokenValid = false;
        }

        foreach (Ps_eventbus::REQUIRED_TABLES as $requiredTable) {
            $query = new DbQuery();

            $query->select('*')
                ->from($requiredTable)
                ->limit(1);

            try {
                $this->db->executeS($query);
            } catch (PrestaShopDatabaseException $e) {
                $allTablesInstalled = false;
                break;
            }
        }

        if (defined('PHP_VERSION') && defined('PHP_EXTRA_VERSION')) {
            $phpVersion = str_replace(PHP_EXTRA_VERSION, '', PHP_VERSION);
        } else {
            $phpVersion = (string) explode('-', (string) phpversion())[0];
        }

        return [
            'prestashop_version' => _PS_VERSION_,
            'ps_eventbus_version' => Ps_eventbus::VERSION,
            'php_version' => $phpVersion,
            'ps_account' => $tokenValid,
            'ps_eventbus' => $allTablesInstalled,
            'env' => [
                'EVENT_BUS_PROXY_API_URL' => isset($this->configuration['EVENT_BUS_PROXY_API_URL']) ? $this->configuration['EVENT_BUS_PROXY_API_URL'] : null,
                'EVENT_BUS_SYNC_API_URL' => isset($this->configuration['EVENT_BUS_SYNC_API_URL']) ? $this->configuration['EVENT_BUS_SYNC_API_URL'] : null,
            ],
        ];
    }
}
