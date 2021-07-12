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

namespace PrestaShop\PrestaShop\Core\Import\File;

use PrestaShop\PrestaShop\Core\Import\ImportDirectory;
use PrestaShopBundle\Exception\FileUploadException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * FileUploader is responsible for uploading import files to import directory.
 */
final class FileUploader
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var ImportDirectory
     */
    private $importDirectory;

    /**
     * @param TranslatorInterface $translator
     * @param ImportDirectory $importDirectory
     */
    public function __construct(
        TranslatorInterface $translator,
        ImportDirectory $importDirectory
    ) {
        $this->translator = $translator;
        $this->importDirectory = $importDirectory;
    }

    /**
     * Handle import file uploading to admin import/ directory.
     *
     * @param UploadedFile $uploadedFile
     *
     * @return File
     *
     * @throws FileUploadException
     */
    public function upload(UploadedFile $uploadedFile)
    {
        if ($error = $this->validateUploadedFile($uploadedFile)) {
            throw new FileUploadException($error);
        }

        $uploadedFileName = sprintf(
            '%s-%s',
            date('YmdHis'),
            $uploadedFile->getClientOriginalName()
        );

        try {
            $file = $uploadedFile->move(
                $this->importDirectory,
                $uploadedFileName
            );
        } catch (FileException $e) {
            $error = $this->translator->trans('An error occurred while uploading / copying the file.', [], 'Admin.Advparameters.Notification');

            throw new FileUploadException($error);
        }

        return $file;
    }

    /**
     * Check if uploaded file is valid.
     *
     * @param UploadedFile $uploadedFile
     *
     * @return string|false Returns error string on error or FALSE otherwise
     */
    protected function validateUploadedFile(UploadedFile $uploadedFile)
    {
        $error = false;

        switch ($uploadedFile->getError()) {
            case UPLOAD_ERR_INI_SIZE:
                $error = $this->translator->trans('The uploaded file exceeds the upload_max_filesize directive in php.ini. If your server configuration allows it, you may add a directive in your .htaccess.', [], 'Admin.Advparameters.Notification');

                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = $this->translator->trans('The uploaded file exceeds the post_max_size directive in php.ini. If your server configuration allows it, you may add a directive in your .htaccess, for example:', [], 'Admin.Advparameters.Notification');
                $error = sprintf('%s %s', $message, 'php_value post_max_size 20M');

                break;
            case UPLOAD_ERR_PARTIAL:
                $error = $this->translator->trans('The uploaded file was only partially uploaded.', [], 'Admin.Advparameters.Notification');

                break;
            case UPLOAD_ERR_NO_FILE:
                $error = $this->translator->trans('No file was uploaded.', [], 'Admin.Advparameters.Notification');

                break;
        }

        if ($error) {
            return $error;
        }

        if (!preg_match('#([^\.]*?)\.(csv|xls[xt]?|o[dt]s)$#is', $uploadedFile->getClientOriginalName())) {
            $error = $this->translator->trans('The extension of your file should be .csv.', [], 'Admin.Advparameters.Notification');
        }

        return $error;
    }
}
