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

namespace PrestaShop\PrestaShop\Adapter\Import;

use PrestaShop\PrestaShop\Core\File\Converter\FileConverterInterface;
use PrestaShop\PrestaShop\Core\Import\Exception\UnreadableFileException;
use PrestaShop\PrestaShop\Core\Import\File\FileOpenerInterface;
use PrestaShop\PrestaShop\Core\Import\ImportDirectory;
use SplFileInfo;

/**
 * Class CsvFileOpener is responsible for opening the CSV import file.
 */
final class CsvFileOpener implements FileOpenerInterface
{
    /**
     * @var FileConverterInterface
     */
    private $excelToCsvConverter;

    /**
     * @var ImportDirectory
     */
    private $importDirectory;

    /**
     * @param FileConverterInterface $excelToCsvConverter
     * @param ImportDirectory $importDirectory
     */
    public function __construct(
        FileConverterInterface $excelToCsvConverter,
        ImportDirectory $importDirectory
    ) {
        $this->excelToCsvConverter = $excelToCsvConverter;
        $this->importDirectory = $importDirectory;
    }

    /**
     * {@inheritdoc}
     */
    public function open(SplFileInfo $file)
    {
        $importFile = $this->excelToCsvConverter->convert($file);
        $filePath = $importFile->getPathname();
        $isReadableFile = is_file($filePath) && is_readable($filePath);

        if (!$isReadableFile || !($handle = fopen($filePath, 'r'))) {
            throw new UnreadableFileException();
        }

        $this->rewindBomAware($handle);

        return $handle;
    }

    /**
     * Rewind the file handle, skipping BOM signature.
     *
     * @param resource $handle
     */
    private function rewindBomAware($handle)
    {
        if (!is_resource($handle)) {
            return;
        }

        rewind($handle);

        if (($bom = fread($handle, 3)) != "\xEF\xBB\xBF") {
            rewind($handle);
        }
    }
}
