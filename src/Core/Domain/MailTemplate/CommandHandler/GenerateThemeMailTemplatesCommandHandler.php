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

namespace PrestaShop\PrestaShop\Core\Domain\MailTemplate\CommandHandler;

use PrestaShop\PrestaShop\Core\Domain\MailTemplate\Command\GenerateThemeMailTemplatesCommand;
use PrestaShop\PrestaShop\Core\Exception\InvalidArgumentException;
use PrestaShop\PrestaShop\Core\Language\LanguageInterface;
use PrestaShop\PrestaShop\Core\Language\LanguageRepositoryInterface;
use PrestaShop\PrestaShop\Core\MailTemplate\MailTemplateGenerator;
use PrestaShop\PrestaShop\Core\MailTemplate\ThemeCatalogInterface;
use PrestaShop\PrestaShop\Core\MailTemplate\ThemeInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class GenerateThemeMailTemplatesCommandHandler generates email templates with parameters provided
 * by GenerateThemeMailTemplatesCommand. If no output folders are defined by the command its output
 * folders are the default ones.
 */
class GenerateThemeMailTemplatesCommandHandler implements GenerateThemeMailTemplatesCommandHandlerInterface
{
    /** @var LanguageRepositoryInterface */
    private $languageRepository;

    /** @var ThemeCatalogInterface */
    private $themeCatalog;

    /** @var MailTemplateGenerator */
    private $generator;

    /** @var TranslatorInterface */
    private $translator;

    /** @var string */
    private $defaultCoreMailsFolder;

    /** @var string */
    private $defaultModulesMailFolder;

    /**
     * @param LanguageRepositoryInterface $languageRepository
     * @param ThemeCatalogInterface $themeCatalog
     * @param MailTemplateGenerator $generator
     * @param TranslatorInterface $translator
     * @param string $defaultCoreMailsFolder
     * @param string $defaultModulesMailFolder
     */
    public function __construct(
        LanguageRepositoryInterface $languageRepository,
        ThemeCatalogInterface $themeCatalog,
        MailTemplateGenerator $generator,
        TranslatorInterface $translator,
        $defaultCoreMailsFolder,
        $defaultModulesMailFolder
    ) {
        $this->languageRepository = $languageRepository;
        $this->themeCatalog = $themeCatalog;
        $this->generator = $generator;
        $this->translator = $translator;
        $this->defaultCoreMailsFolder = $defaultCoreMailsFolder;
        $this->defaultModulesMailFolder = $defaultModulesMailFolder;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(GenerateThemeMailTemplatesCommand $command)
    {
        /** @var LanguageInterface $language */
        $language = $this->languageRepository->getOneByLocaleOrIsoCode($command->getLanguage());
        if (null === $language) {
            throw new InvalidArgumentException(sprintf('Could not find Language for locale: %s', $command->getLanguage()));
        }

        /** @var ThemeInterface $theme */
        $theme = $this->themeCatalog->getByName($command->getThemeName());

        $coreMailsFolder = $command->getCoreMailsFolder() ?: $this->defaultCoreMailsFolder;
        $modulesMailFolder = $command->getModulesMailFolder() ?: $this->defaultModulesMailFolder;

        $this->generator->generateTemplates($theme, $language, $coreMailsFolder, $modulesMailFolder, $command->overwriteTemplates());
    }
}
