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

namespace PrestaShop\PrestaShop\Adapter\Language;

use Language;
use PrestaShop\PrestaShop\Core\Foundation\Version;
use PrestaShop\PrestaShop\Core\Language\Pack\LanguagePackInstallerInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class LanguagePack is responsible for the language pack actions regarding installation.
 */
final class LanguagePackInstaller implements LanguagePackInstallerInterface
{
    /**
     * @var Version
     */
    private $version;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * LanguagePackInstaller constructor.
     *
     * @param TranslatorInterface $translator
     * @param Version $version
     */
    public function __construct(TranslatorInterface $translator, Version $version)
    {
        $this->version = $version;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function downloadAndInstallLanguagePack($iso)
    {
        $freshInstall = empty(Language::getIdByIso($iso));
        $result = Language::downloadAndInstallLanguagePack($iso, $this->version->getVersion(), null, $freshInstall);

        if (false === $result) {
            return [
                $this->translator->trans(
                    'Fatal error: ISO code is not correct',
                    [],
                    'Admin.International.Notification'
                ),
            ];
        }

        if (is_array($result) && !empty($result)) {
            return $result;
        }

        return [];
    }
}
