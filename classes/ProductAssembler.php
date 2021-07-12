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
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;

/**
 * Class ProductAssemblerCore.
 */
class ProductAssemblerCore
{
    private $context;
    private $searchContext;

    /**
     * ProductAssemblerCore constructor.
     *
     * @param \Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
        $this->searchContext = new ProductSearchContext($context);
    }

    /**
     * Add missing product fields.
     *
     * @param array $rawProduct
     *
     * @return array
     */
    private function addMissingProductFields(array $rawProduct)
    {
        $idShop = (int) $this->searchContext->getIdShop();
        $idLang = (int) $this->searchContext->getIdLang();
        $idProduct = (int) $rawProduct['id_product'];
        $prefix = _DB_PREFIX_;

        $nbDaysNewProduct = (int) Configuration::get('PS_NB_DAYS_NEW_PRODUCT');
        if (!Validate::isUnsignedInt($nbDaysNewProduct)) {
            $nbDaysNewProduct = 20;
        }

        $now = date('Y-m-d') . ' 00:00:00';

        $sql = "SELECT
                    p.*,
                    pl.*,
                    sa.out_of_stock,
                    IFNULL(sa.quantity, 0) as quantity,
                    (DATEDIFF(
				p.`date_add`,
				DATE_SUB(
					'$now',
					INTERVAL $nbDaysNewProduct DAY
				)
			) > 0) as new
                FROM {$prefix}product p
                LEFT JOIN {$prefix}product_lang pl
                    ON pl.id_product = p.id_product
                    AND pl.id_shop = $idShop
                    AND pl.id_lang = $idLang
                LEFT JOIN {$prefix}stock_available sa
			        ON sa.id_product = p.id_product 
			        AND sa.id_shop = $idShop
			    WHERE p.id_product = $idProduct";

        $rows = Db::getInstance()->executeS($sql);
        if ($rows === false) {
            return $rawProduct;
        }

        return array_merge($rows[0], $rawProduct);
    }

    /**
     * Assemble Product.
     *
     * @param array $rawProduct
     *
     * @return mixed
     */
    public function assembleProduct(array $rawProduct)
    {
        $enrichedProduct = $this->addMissingProductFields($rawProduct);

        return Product::getProductProperties(
            $this->searchContext->getIdLang(),
            $enrichedProduct,
            $this->context
        );
    }
}
