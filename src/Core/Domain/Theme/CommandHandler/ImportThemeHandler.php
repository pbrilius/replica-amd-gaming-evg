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

namespace PrestaShop\PrestaShop\Core\Domain\Theme\CommandHandler;

use PrestaShop\PrestaShop\Core\Addon\Theme\Exception\ThemeAlreadyExistsException;
use PrestaShop\PrestaShop\Core\Addon\Theme\ThemeManager;
use PrestaShop\PrestaShop\Core\Addon\Theme\ThemeUploaderInterface;
use PrestaShop\PrestaShop\Core\ConfigurationInterface;
use PrestaShop\PrestaShop\Core\Domain\Theme\Command\ImportThemeCommand;
use PrestaShop\PrestaShop\Core\Domain\Theme\Exception\ImportedThemeAlreadyExistsException;
use PrestaShop\PrestaShop\Core\Domain\Theme\ValueObject\ThemeImportSource;
use PrestaShop\PrestaShop\Core\Domain\Theme\ValueObject\ThemeName;

/**
 * Class ImportThemeHandler
 */
final class ImportThemeHandler implements ImportThemeHandlerInterface
{
    /**
     * @var ThemeUploaderInterface
     */
    private $themeUploader;

    /**
     * @var ThemeManager
     */
    private $themeManager;

    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @param ThemeUploaderInterface $themeUploader
     * @param ThemeManager $themeManager
     * @param ConfigurationInterface $configuration
     */
    public function __construct(
        ThemeUploaderInterface $themeUploader,
        ThemeManager $themeManager,
        ConfigurationInterface $configuration
    ) {
        $this->themeUploader = $themeUploader;
        $this->themeManager = $themeManager;
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(ImportThemeCommand $command)
    {
        $type = $command->getImportSource()->getSourceType();
        $source = $command->getImportSource()->getSource();

        if (ThemeImportSource::FROM_ARCHIVE === $type) {
            $themePath = $this->themeUploader->upload($source);
        } elseif (ThemeImportSource::FROM_WEB === $type) {
            $themePath = $source;
        } elseif (ThemeImportSource::FROM_FTP === $type) {
            $themePath = $this->configuration->get('_PS_ALL_THEMES_DIR_') . $source;
        }

        try {
            $this->themeManager->install($themePath);
        } catch (ThemeAlreadyExistsException $e) {
            throw new ImportedThemeAlreadyExistsException(new ThemeName($e->getThemeName()), sprintf('Imported theme "%s" already exists.', $e->getThemeName()), 0, $e);
        } finally {
            if (ThemeImportSource::FROM_ARCHIVE === $type) {
                @unlink($themePath);
            }
        }
    }
}
