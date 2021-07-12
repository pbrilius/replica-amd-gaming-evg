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

/**
 * Not used in PrestaShop.
 *
 * @deprecated since 1.7.5, to be removed in 1.8
 */
class ClassLang
{
    /**
     * @var string
     */
    private $locale;

    /**
     * ClassLang constructor.
     *
     * @param $locale
     */
    public function __construct($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param $className
     *
     * @return bool
     */
    public function getClassLang($className)
    {
        if (!class_exists($className)) {
            return false;
        }

        return new $className($this->locale);
    }
}
