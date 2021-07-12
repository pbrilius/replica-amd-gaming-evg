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

namespace PrestaShop\PrestaShop\Core\File;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Class InvoiceModelFinder finds invoice model files.
 */
final class InvoiceModelFinder implements FileFinderInterface
{
    /**
     * @var array
     */
    private $invoiceModelDirectories;

    /**
     * @param array $invoiceModelDirectories
     */
    public function __construct(array $invoiceModelDirectories)
    {
        $this->invoiceModelDirectories = $invoiceModelDirectories;
    }

    /**
     * Finds all invoice model files.
     *
     * @return array
     */
    public function find()
    {
        $directories = $this->invoiceModelDirectories;
        $filesystem = new Filesystem();

        foreach ($directories as $key => $directory) {
            if (!$filesystem->exists($directory)) {
                unset($directories[$key]);
            }
        }

        $finder = new Finder();
        $finder->files()
            ->in($directories)
            ->name('invoice-*.tpl');

        $fileNames = [];

        foreach ($finder as $file) {
            $fileNames[] = $file->getFilename();
        }

        return $fileNames;
    }
}
