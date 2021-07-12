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

namespace PrestaShop\PrestaShop\Core\Import\Sample;

use PrestaShop\PrestaShop\Core\ConfigurationInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class SampleFileProvider is responsible for providing sample import files.
 */
final class SampleFileProvider implements SampleFileProviderInterface
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
    public function getFile($sampleFileName)
    {
        $path = $this->configuration->get('_PS_ROOT_DIR_') .
              DIRECTORY_SEPARATOR .
              'docs' .
              DIRECTORY_SEPARATOR .
              'csv_import' .
              DIRECTORY_SEPARATOR;

        try {
            $sampleFile = new File($path . $sampleFileName . '.csv');
        } catch (FileNotFoundException $e) {
            return null;
        }

        return $sampleFile;
    }
}
