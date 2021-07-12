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

namespace PrestaShop\PrestaShop\Core\Image\Deleter;

/**
 * Interface ImageFileDeleterInterface describes an image file deleter.
 */
interface ImageFileDeleterInterface
{
    /**
     * Recursively deletes all images in the given path and removes empty folders.
     *
     * @param string $path images directory
     * @param bool $recursively if true deletes images from subdirectories
     * @param bool $deleteSubdirectories if true deletes the subdirectories as well
     * @param string $format image format
     *
     * @return bool
     */
    public function deleteFromPath($path, $recursively = false, $deleteSubdirectories = false, $format = 'jpg');

    /**
     * Delete all images from given path.
     *
     * @param string $path
     * @param string $format
     */
    public function deleteAllImages($path, $format = 'jpg');
}
