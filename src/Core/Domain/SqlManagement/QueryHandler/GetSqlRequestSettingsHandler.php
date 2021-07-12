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

namespace PrestaShop\PrestaShop\Core\Domain\SqlManagement\QueryHandler;

use PrestaShop\PrestaShop\Core\ConfigurationInterface;
use PrestaShop\PrestaShop\Core\Domain\SqlManagement\Query\GetSqlRequestSettings;
use PrestaShop\PrestaShop\Core\Domain\SqlManagement\SqlRequestSettings;
use PrestaShop\PrestaShop\Core\Encoding\CharsetEncoding;

/**
 * Class GetSqlRequestSettingsHandler handles query to get SqlRequest settings.
 */
final class GetSqlRequestSettingsHandler implements GetSqlRequestSettingsHandlerInterface
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
    public function handle(GetSqlRequestSettings $query)
    {
        $fileEncodingIntValue = $this->configuration->get(SqlRequestSettings::FILE_ENCODING);

        return new SqlRequestSettings(
            $this->getFileEncoding($fileEncodingIntValue)
        );
    }

    /**
     * File encodings are saved as integer values in databases.
     *
     * @param int|null $rawValue
     *
     * @return string
     */
    private function getFileEncoding($rawValue)
    {
        $valuesMapping = [
            1 => CharsetEncoding::UTF_8,
            2 => CharsetEncoding::ISO_8859_1,
        ];

        if (isset($valuesMapping[$rawValue])) {
            return $valuesMapping[$rawValue];
        }

        return CharsetEncoding::UTF_8;
    }
}
