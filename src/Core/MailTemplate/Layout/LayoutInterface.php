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

namespace PrestaShop\PrestaShop\Core\MailTemplate\Layout;

/**
 * Interface LayoutInterface is used to contain the basic info about a mail layout.
 */
interface LayoutInterface
{
    /**
     * Name of the layout to describe its purpose
     *
     * @return string
     */
    public function getName();

    /**
     * Absolute path of the html layout file
     *
     * @return string
     */
    public function getHtmlPath();

    /**
     * Absolute path of the html layout file
     *
     * @return string
     */
    public function getTxtPath();

    /**
     * Which module this layout is associated to (if any)
     *
     * @return string|null
     */
    public function getModuleName();
}
