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

namespace PrestaShop\PrestaShop\Adapter\Employee;

use Language;
use PrestaShop\PrestaShop\Adapter\LegacyContext;
use PrestaShop\PrestaShop\Core\Employee\FormLanguageChangerInterface;

/**
 * Class FormLanguageChanger is responsible for changing the language,
 * which is used in forms by the employee.
 * It is not the language in which form texts are translated, but rather
 * the language, which is selected by default in the translatable fields.
 */
final class FormLanguageChanger implements FormLanguageChangerInterface
{
    /**
     * @var LegacyContext
     */
    private $legacyContext;

    /**
     * @param LegacyContext $legacyContext
     */
    public function __construct(LegacyContext $legacyContext)
    {
        $this->legacyContext = $legacyContext;
    }

    /**
     * {@inheritdoc}
     */
    public function changeLanguageInCookies($languageIsoCode)
    {
        $this->legacyContext->getContext()->cookie->employee_form_lang = (int) Language::getIdByIso($languageIsoCode);
        $this->legacyContext->getContext()->cookie->write();
    }
}
