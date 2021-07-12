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

namespace PrestaShop\PrestaShop\Core\Language\Pack\Loader;

use PrestaShop\PrestaShop\Core\Foundation\Version;

/**
 * Class RemoteLanguagePackLoader is responsible for retrieving language pack data from remote host.
 */
final class RemoteLanguagePackLoader implements LanguagePackLoaderInterface
{
    /**
     * The link from which available languages are retrieved.
     */
    const PACK_LINK = 'http://i18n.prestashop.com/translations/%ps_version%/available_languages.json';

    /**
     * @var Version
     */
    private $version;

    /**
     * @param Version $version
     */
    public function __construct(Version $version)
    {
        $this->version = $version;
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguagePackList()
    {
        $normalizedLink = str_replace('%ps_version%', $this->version->getVersion(), self::PACK_LINK);
        $jsonResponse = file_get_contents($normalizedLink);

        $result = [];
        if ($jsonResponse) {
            $result = json_decode($jsonResponse, true);
        }

        return $result;
    }
}
