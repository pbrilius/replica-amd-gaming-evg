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
use PrestaShop\PrestaShop\Core\ConfigurationInterface;

abstract class AbstractAssetManagerCore
{
    protected $directories;
    protected $configuration;
    protected $list = [];

    const DEFAULT_MEDIA = 'all';
    const DEFAULT_PRIORITY = 50;
    const DEFAULT_JS_POSITION = 'bottom';

    use PrestaShop\PrestaShop\Adapter\Assets\AssetUrlGeneratorTrait;

    public function __construct(array $directories, ConfigurationInterface $configuration)
    {
        $this->directories = $directories;
        $this->configuration = $configuration;

        $this->list = $this->getDefaultList();
    }

    abstract protected function getDefaultList();

    abstract protected function getList();

    /**
     * @param string $relativePath
     *
     * @return bool|string
     */
    public function getFullPath(string $relativePath)
    {
        foreach ($this->getDirectories() as $baseDir) {
            $fullPath = $baseDir . ltrim($relativePath, '/'); // not DIRECTORY_SEPARATOR because, it's path included manually
            if (file_exists($this->getPathFromUri($fullPath))) {
                return $fullPath;
            }
        }

        return false;
    }

    private function getDirectories()
    {
        static $directories;

        if (null === $directories) {
            foreach ($this->directories as $baseDir) {
                if (!empty($baseDir)) {
                    $directories[] = $baseDir;
                }
            }
        }

        return $directories;
    }
}
