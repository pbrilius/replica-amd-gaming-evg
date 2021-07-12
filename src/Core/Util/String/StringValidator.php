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

namespace PrestaShop\PrestaShop\Core\Util\String;

/**
 * This class defines reusable methods for checking strings under certain conditions.
 */
final class StringValidator implements StringValidatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function startsWith($string, $prefix)
    {
        return strpos($string, $prefix) === 0;
    }

    /**
     * {@inheritdoc}
     */
    public function endsWith($string, $suffix)
    {
        $length = strlen($suffix);

        if (0 === $length) {
            return false;
        }

        return substr($string, -$length) === $suffix;
    }

    /**
     * {@inheritdoc}
     */
    public function startsWithAndEndsWith($string, $prefix, $suffix)
    {
        return $this->startsWith($string, $prefix) && $this->endsWith($string, $suffix);
    }

    /**
     * {@inheritdoc}
     */
    public function doesContainsWhiteSpaces($string)
    {
        return preg_match('/\s/', $string);
    }
}
