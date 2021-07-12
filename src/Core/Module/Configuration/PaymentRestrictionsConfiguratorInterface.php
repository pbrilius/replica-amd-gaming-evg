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

namespace PrestaShop\PrestaShop\Core\Module\Configuration;

/**
 * Interface PaymentRestrictionsConfigurator defines contract for payment module restrications configurator.
 */
interface PaymentRestrictionsConfiguratorInterface
{
    /**
     * Configure payment module restrictions for currencies.
     *
     * @param array $currencyRestrictions
     *
     * @return bool
     */
    public function configureCurrencyRestrictions(array $currencyRestrictions);

    /**
     * Configure payment module restrictions for countries.
     *
     * @param array $countryRestrictions
     *
     * @return bool
     */
    public function configureCountryRestrictions(array $countryRestrictions);

    /**
     * Configure payment module restrictions for customer groups.
     *
     * @param array $groupRestrictions
     *
     * @return bool
     */
    public function configureGroupRestrictions(array $groupRestrictions);

    /**
     * Configure payment module restrictions for carriers.
     *
     * @param array $groupRestrictions
     *
     * @return bool
     */
    public function configureCarrierRestrictions(array $groupRestrictions);
}
