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

namespace PrestaShop\PrestaShop\Adapter\Language\Pack;

use PrestaShop\PrestaShop\Adapter\Language\LanguageDataProvider;
use PrestaShop\PrestaShop\Core\Cache\Clearer\CacheClearerInterface;
use PrestaShop\PrestaShop\Core\Language\Pack\Import\LanguagePackImporterInterface;
use PrestaShop\PrestaShop\Core\Language\Pack\LanguagePackInstallerInterface;

/**
 * Class LanguagePackImporter is responsible for importing language pack.
 */
final class LanguagePackImporter implements LanguagePackImporterInterface
{
    /**
     * @var LanguagePackInstallerInterface
     */
    private $languagePack;

    /**
     * @var LanguageDataProvider
     */
    private $languageProvider;

    /**
     * @var CacheClearerInterface
     */
    private $entireCacheClearer;

    /**
     * @var string
     */
    private $translationsDir;

    /**
     * @param LanguagePackInstallerInterface $languagePack
     * @param LanguageDataProvider $languageProvider
     * @param CacheClearerInterface $entireCacheClearer
     * @param string $translationsDir
     */
    public function __construct(
        LanguagePackInstallerInterface $languagePack,
        LanguageDataProvider $languageProvider,
        CacheClearerInterface $entireCacheClearer,
        $translationsDir
    ) {
        $this->languagePack = $languagePack;
        $this->languageProvider = $languageProvider;
        $this->entireCacheClearer = $entireCacheClearer;
        $this->translationsDir = $translationsDir;
    }

    /**
     * {@inheritdoc}
     */
    public function import($isoCode)
    {
        $result = $this->languagePack->downloadAndInstallLanguagePack($isoCode);

        if (!empty($result)) {
            return $result;
        }

        $this->entireCacheClearer->clear();

        return [];
    }

    /**
     * Gets language code in format of ISO 639-1.
     *
     * @param string $languageCode - language code to format
     *
     * @return string
     */
    private function getFormattedLanguageCode($languageCode)
    {
        $explodedLangCode = explode('-', $languageCode);

        return sprintf(
            '%s-%s',
            isset($explodedLangCode[0]) ? $explodedLangCode[0] : '',
            isset($explodedLangCode[1]) ? strtoupper($explodedLangCode[1]) : ''
        );
    }
}
