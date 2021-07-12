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


namespace PrestaShop\Module\PsEventbus\Repository;

use Db;
use DbQuery;

class ImageRepository
{
    /**
     * @var Db
     */
    private $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    /**
     * @param int $productId
     * @param int $shopId
     *
     * @return false|string|null
     */
    public function getProductCoverImage($productId, $shopId)
    {
        $query = new DbQuery();

        $query->select('imgs.id_image')
            ->from('image_shop', 'imgs')
            ->where('imgs.cover = 1')
            ->where('imgs.id_shop = ' . (int) $shopId)
            ->where('imgs.id_product = ' . (int) $productId);

        return $this->db->getValue($query);
    }

    /**
     * @param int $productId
     * @param int $attributeId
     * @param int $shopId
     * @param bool $includeCover
     *
     * @return array|bool|\mysqli_result|\PDOStatement|resource|null
     *
     * @throws \PrestaShopDatabaseException
     */
    public function getProductImages($productId, $attributeId, $shopId, $includeCover = false)
    {
        $query = new DbQuery();

        $query->select('imgs.id_image')
            ->from('image_shop', 'imgs')
            ->leftJoin('image', 'img', 'imgs.id_image = img.id_image')
            ->where('imgs.id_shop = ' . (int) $shopId)
            ->where('imgs.id_product = ' . (int) $productId)
            ->orderBy('img.position ASC');

        if ((int) $attributeId !== 0) {
            $query->innerJoin(
                'product_attribute_image',
                'pai',
                'imgs.id_image = pai.id_image AND pai.id_product_attribute = ' . (int) $attributeId
            );
        }

        if (!$includeCover) {
            $query->where('(imgs.cover IS NULL OR imgs.cover = 0)');
        }

        return $this->db->executeS($query);
    }
}
