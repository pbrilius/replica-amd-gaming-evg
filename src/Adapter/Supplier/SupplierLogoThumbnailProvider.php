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

namespace PrestaShop\PrestaShop\Adapter\Supplier;

use PrestaShop\PrestaShop\Adapter\ImageManager;
use PrestaShop\PrestaShop\Core\Image\ImageProviderInterface;
use PrestaShop\PrestaShop\Core\Image\Parser\ImageTagSourceParserInterface;

/**
 * Class SupplierLogoThumbnailProvider is responsible for providing thumbnail path for supplier logo image.
 */
final class SupplierLogoThumbnailProvider implements ImageProviderInterface
{
    /**
     * @var ImageTagSourceParserInterface
     */
    private $imageTagSourceParser;

    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * @param ImageTagSourceParserInterface $imageTagSourceParser
     * @param ImageManager $imageManager
     */
    public function __construct(
        ImageTagSourceParserInterface $imageTagSourceParser,
        ImageManager $imageManager
    ) {
        $this->imageTagSourceParser = $imageTagSourceParser;
        $this->imageManager = $imageManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath($supplierId)
    {
        $imageTag = $this->imageManager->getThumbnailForListing(
            $supplierId,
            'jpg',
            'supplier',
            _PS_SUPP_IMG_DIR_
        );

        return $this->imageTagSourceParser->parse($imageTag);
    }
}
