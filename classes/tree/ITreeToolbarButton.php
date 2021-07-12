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
interface ITreeToolbarButtonCore
{
    public function __toString();

    public function setAttribute($name, $value);

    public function getAttribute($name);

    public function setAttributes($value);

    public function getAttributes();

    public function setClass($value);

    public function getClass();

    public function setContext($value);

    public function getContext();

    public function setId($value);

    public function getId();

    public function setLabel($value);

    public function getLabel();

    public function setName($value);

    public function getName();

    public function setTemplate($value);

    public function getTemplate();

    public function setTemplateDirectory($value);

    public function getTemplateDirectory();

    public function hasAttribute($name);

    public function render();
}
