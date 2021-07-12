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

class GamificationTools
{
    public static function parseMetaData($content)
    {
        $meta_data = array(
            'PREFIX_' => _DB_PREFIX_,
            );
        //replace define
        $content = str_replace(array_keys($meta_data), array_values($meta_data), $content);
        
        //replace meta data
        $content = preg_replace_callback('#\{config\}([a-zA-Z0-9_-]*)\{/config\}#', function ($matches) {
            return Configuration::get($matches[1]);
        }, $content);
        $content = preg_replace_callback('#\{link\}(.*)\{/link\}#', function ($matches) {
            return Context::getContext()->link->getAdminLink($matches[1]);
        }, $content);
        $content = preg_replace_callback('#\{employee\}(.*)\{/employee\}#', function ($matches) {
            return Context::getContext()->employee->$matches[1];
        }, $content);
        $content = preg_replace_callback('#\{language\}(.*)\{/language\}#', function ($matches) {
            return Context::getContext()->language->$matches[1];
        }, $content);
        $content = preg_replace_callback('#\{country\}(.*)\{/country\}#', function ($matches) {
            return Context::getContext()->country->$matches[1];
        }, $content);
        
        return $content;
    }

    /**
     * Retrieve Json api file, forcing gzip compression to save bandwith.
     *
     * @param string $url
     * @param bool $withResponseHeaders
     *
     * @return string|bool
     */
    public static function retrieveJsonApiFile($url, $withResponseHeaders = false)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_MAXREDIRS, 2);
        // @see https://cloud.google.com/appengine/kb/#compression
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        curl_setopt($curl, CURLOPT_USERAGENT, 'gzip');
        curl_setopt($curl, CURLOPT_HEADER, $withResponseHeaders);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($curl);

        curl_close($curl);

        return $content;
    }
}
