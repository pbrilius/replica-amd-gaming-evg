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
class APIFAQ
{
    /**
     * @param string $module_key
     * @param mixed $version
     *
     * @return object|false
     */
    public function getData($module_key, $version)
    {
        if (function_exists('curl_init') == false) {
            return false;
        }
        $context = Context::getContext();
        $iso_code = Language::getIsoById($context->language->id);
        $url = 'http://api.addons.prestashop.com/request/faq/' . $module_key . '/' . $version . '/' . $iso_code;
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
        ];
        $CURL = curl_init();
        curl_setopt_array($CURL, $options);
        $content = curl_exec($CURL);
        curl_close($CURL);
        if (!$content) {
            return false;
        }
        /** @var object $content */
        $content = Tools::jsonDecode($content, true);
        if (empty($content->categories)) {
            return false;
        }

        return $content->categories;
    }
}
