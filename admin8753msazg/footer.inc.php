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
@trigger_error('Using '.__FILE__.' to do template rendering is deprecated since 1.7.6.0 and will be removed in the next major version. Use a controller instead.', E_USER_DEPRECATED);

$dir = Context::getContext()->smarty->getTemplateDir(0).'controllers'.DIRECTORY_SEPARATOR.trim($con->override_folder, '\\/').DIRECTORY_SEPARATOR;
$footer_tpl = file_exists($dir.'footer.tpl') ? $dir.'footer.tpl' : 'footer.tpl';
echo Context::getContext()->smarty->fetch($footer_tpl);
