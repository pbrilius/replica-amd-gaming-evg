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

namespace PrestaShop\PrestaShop\Adapter;

use Combination;
use PrestaShop\Decimal\Number;
use PrestaShop\PrestaShop\Adapter\Product\ProductDataProvider;
use PrestaShop\PrestaShop\Core\Localization\Locale;
use PrestaShopBundle\Form\Admin\Type\CommonAbstractType;
use Product;

/**
 * This class will provide data from DB / ORM about product combination.
 */
class CombinationDataProvider
{
    /**
     * @var LegacyContext
     */
    private $context;

    /**
     * @var ProductDataProvider
     */
    private $productAdapter;

    /**
     * @var Locale
     */
    private $locale;

    /**
     * @param Locale $locale
     */
    public function __construct(Locale $locale)
    {
        $this->context = new LegacyContext();
        $this->productAdapter = new ProductDataProvider();
        $this->locale = $locale;
    }

    /**
     * Get a combination values.
     *
     * @deprecated since 1.7.3.1 really slow, use getFormCombinations instead.
     *
     * @param int $combinationId The id_product_attribute
     *
     * @return array combinations
     */
    public function getFormCombination($combinationId)
    {
        $product = new Product((new Combination($combinationId))->id_product);

        return $this->completeCombination(
            $product->getAttributeCombinationsById(
                $combinationId,
                $this->context->getContext()->language->id
            ),
            $product
        );
    }

    /**
     * Retrieve combinations data for a specific language id.
     *
     * @param array $combinationIds
     * @param int $languageId
     *
     * @return array a list of formatted combinations
     *
     * @throws \PrestaShopDatabaseException
     * @throws \PrestaShopException
     */
    public function getFormCombinations(array $combinationIds, $languageId)
    {
        $productId = (new Combination($combinationIds[0]))->id_product;
        $product = new Product($productId);
        $combinations = [];

        foreach ($combinationIds as $combinationId) {
            $combinations[$combinationId] = $this->completeCombination(
                $product->getAttributeCombinationsById(
                    $combinationId,
                    $languageId
                ),
                $product
            );
        }

        return $combinations;
    }

    /**
     * @param array $attributesCombinations
     * @param Product $product
     *
     * @return array
     */
    public function completeCombination($attributesCombinations, $product)
    {
        $combination = $attributesCombinations[0];

        $attribute_price_impact = 0;
        if ($combination['price'] > 0) {
            $attribute_price_impact = 1;
        } elseif ($combination['price'] < 0) {
            $attribute_price_impact = -1;
        }

        $attribute_weight_impact = 0;
        if ($combination['weight'] > 0) {
            $attribute_weight_impact = 1;
        } elseif ($combination['weight'] < 0) {
            $attribute_weight_impact = -1;
        }

        $attribute_unity_price_impact = 0;
        if ($combination['unit_price_impact'] > 0) {
            $attribute_unity_price_impact = 1;
        } elseif ($combination['unit_price_impact'] < 0) {
            $attribute_unity_price_impact = -1;
        }

        $finalPrice = (new Number((string) $product->price))
            ->plus(new Number((string) $combination['price']))
            ->toPrecision(CommonAbstractType::PRESTASHOP_DECIMALS);

        return [
            'id_product_attribute' => $combination['id_product_attribute'],
            'attribute_reference' => $combination['reference'],
            'attribute_ean13' => $combination['ean13'],
            'attribute_isbn' => $combination['isbn'],
            'attribute_upc' => $combination['upc'],
            'attribute_mpn' => $combination['mpn'],
            'attribute_wholesale_price' => $combination['wholesale_price'],
            'attribute_price_impact' => $attribute_price_impact,
            'attribute_price' => $combination['price'],
            'attribute_price_display' => $this->locale->formatPrice($combination['price'], $this->context->getContext()->currency->iso_code),
            'final_price' => (string) $finalPrice,
            'attribute_priceTI' => '',
            'attribute_ecotax' => $combination['ecotax'],
            'attribute_weight_impact' => $attribute_weight_impact,
            'attribute_weight' => $combination['weight'],
            'attribute_unit_impact' => $attribute_unity_price_impact,
            'attribute_unity' => $combination['unit_price_impact'],
            'attribute_minimal_quantity' => $combination['minimal_quantity'],
            'attribute_low_stock_threshold' => $combination['low_stock_threshold'],
            'attribute_low_stock_alert' => (bool) $combination['low_stock_alert'],
            'available_date_attribute' => $combination['available_date'],
            'attribute_default' => (bool) $combination['default_on'],
            'attribute_location' => $this->productAdapter->getLocation($product->id, $combination['id_product_attribute']),
            'attribute_quantity' => $this->productAdapter->getQuantity($product->id, $combination['id_product_attribute']),
            'name' => $this->getCombinationName($attributesCombinations),
            'id_product' => $product->id,
        ];
    }

    /**
     * @param array $attributesCombinations
     *
     * @return string
     */
    private function getCombinationName($attributesCombinations)
    {
        $name = [];

        foreach ($attributesCombinations as $attribute) {
            $name[] = $attribute['group_name'] . ' - ' . $attribute['attribute_name'];
        }

        return implode(', ', $name);
    }
}
