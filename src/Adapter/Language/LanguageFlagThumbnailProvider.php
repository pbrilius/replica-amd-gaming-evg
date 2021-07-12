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

namespace PrestaShop\PrestaShop\Adapter\Language;

use HelperList;
use ImageManager;
use PrestaShop\PrestaShop\Core\Image\ImageProviderInterface;
use PrestaShop\PrestaShop\Core\Image\Parser\ImageTagSourceParserInterface;

/**
 * Class LanguageThumbnailProvider provides path to language's flag thumbnail.
 */
final class LanguageFlagThumbnailProvider implements ImageProviderInterface
{
    /**
     * @var ImageTagSourceParserInterface
     */
    private $imageTagSourceParser;

    /**
     * @var int
     */
    private $contextShopId;

    /**
     * @param ImageTagSourceParserInterface $imageTagSourceParser
     * @param $contextShopId
     */
    public function __construct(
        ImageTagSourceParserInterface $imageTagSourceParser,
        $contextShopId
    ) {
        $this->imageTagSourceParser = $imageTagSourceParser;
        $this->contextShopId = $contextShopId;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath($languageId)
    {
        $pathToImage = _PS_IMG_DIR_ . 'l' . DIRECTORY_SEPARATOR . $languageId . '.jpg';

        $imageTag = ImageManager::thumbnail(
            $pathToImage,
            'lang_mini_' . $languageId . '_' . $this->contextShopId . '.jpg',
            HelperList::LIST_THUMBNAIL_SIZE,
            'jpg'
        );

        return $this->imageTagSourceParser->parse($imageTag);
    }
}
