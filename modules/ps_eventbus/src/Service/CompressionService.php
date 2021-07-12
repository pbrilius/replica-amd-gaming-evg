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


namespace PrestaShop\Module\PsEventbus\Service;

use Exception;
use PrestaShop\Module\PsEventbus\Formatter\JsonFormatter;

class CompressionService
{
    /**
     * @var JsonFormatter
     */
    private $jsonFormatter;

    public function __construct(JsonFormatter $jsonFormatter)
    {
        $this->jsonFormatter = $jsonFormatter;
    }

    /**
     * Compresses data with gzip
     *
     * @param array $data
     *
     * @return string
     *
     * @throws Exception
     */
    public function gzipCompressData($data)
    {
        if (!extension_loaded('zlib')) {
            throw new Exception('Zlib extension for PHP is not enabled');
        }

        $dataJson = $this->jsonFormatter->formatNewlineJsonString($data);

        if (!$encodedData = gzencode($dataJson)) {
            throw new Exception('Failed encoding data to GZIP');
        }

        return $encodedData;
    }
}
