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

namespace PrestaShop\PrestaShop\Core\Localization\Pack\Loader;

use PrestaShop\PrestaShop\Core\ConfigurationInterface;

/**
 * Class LocalLocalizationPackLoader is responsible for loading localization pack data from local host.
 */
final class LocalLocalizationPackLoader extends AbstractLocalizationPackLoader
{
    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocalizationPackList()
    {
        $rootDir = $this->configuration->get('_PS_ROOT_DIR_');

        $localizationFile = sprintf('%s/localization/localization.xml', $rootDir);
        if (!file_exists($localizationFile)) {
            return null;
        }

        return $this->loadXml($localizationFile);
    }

    /**
     * {@inheritdoc}
     */
    public function getLocalizationPack($countryIso)
    {
        $rootDir = $this->configuration->get('_PS_HOST_MODE_') ?
            $this->configuration->get('_PS_CORE_DIR_') :
            $this->configuration->get('_PS_ROOT_DIR_');

        $localizationPackFile = sprintf('%s/localization/%s.xml', $rootDir, $countryIso);
        if (!file_exists($localizationPackFile)) {
            return null;
        }

        return $this->loadXml($localizationPackFile);
    }
}
