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
class CartChecksumCore implements ChecksumInterface
{
    public $addressChecksum = null;
    private $separator = '_';
    private $subseparator = '-';

    public function __construct(AddressChecksum $addressChecksum)
    {
        $this->addressChecksum = $addressChecksum;
    }

    public function generateChecksum($cart)
    {
        $uniq_id = '';
        $uniq_id .= $cart->id_shop;
        $uniq_id .= $this->separator;
        $uniq_id .= $cart->id_customer;
        $uniq_id .= $this->separator;
        $uniq_id .= $cart->id_guest;
        $uniq_id .= $this->separator;
        $uniq_id .= $cart->id_currency;
        $uniq_id .= $this->separator;
        $uniq_id .= $cart->id_lang;
        $uniq_id .= $this->separator;

        $uniq_id .= $this->addressChecksum->generateChecksum(new Address($cart->id_address_delivery));
        $uniq_id .= $this->separator;
        $uniq_id .= $this->addressChecksum->generateChecksum(new Address($cart->id_address_invoice));
        $uniq_id .= $this->separator;

        $products = $cart->getProducts($refresh = true);
        foreach ($products as $product) {
            $uniq_id .= $product['id_shop']
                . $this->subseparator
                . $product['id_product']
                . $this->subseparator
                . $product['id_product_attribute']
                . $this->subseparator
                . $product['cart_quantity']
                . $this->subseparator
                . $product['total_wt'];
            $uniq_id .= $this->separator;
        }

        $uniq_id = rtrim($uniq_id, $this->separator);
        $uniq_id = rtrim($uniq_id, $this->subseparator);

        return sha1($uniq_id);
    }
}
