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

namespace PrestaShop\PrestaShop\Core\Util\Url;

/**
 * Class UrlFileChecker
 */
final class UrlFileChecker implements UrlFileCheckerInterface
{
    /**
     * @var string
     */
    private $fileDir;

    /**
     * @param string $fileDir
     */
    public function __construct($fileDir)
    {
        $this->fileDir = $fileDir;
    }

    /**
     * @return bool
     */
    public function isHtaccessFileWritable()
    {
        return $this->isFileWritable('.htaccess');
    }

    /**
     * @return bool
     */
    public function isRobotsFileWritable()
    {
        return $this->isFileWritable('robots.txt');
    }

    /**
     * @param string $fileName
     *
     * @return bool
     */
    private function isFileWritable($fileName)
    {
        $filePath = $this->fileDir . DIRECTORY_SEPARATOR . $fileName;

        if (file_exists($filePath)) {
            return is_writable($filePath);
        }

        return is_writable($this->fileDir);
    }
}
