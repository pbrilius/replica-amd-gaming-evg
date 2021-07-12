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

namespace PrestaShop\PrestaShop\Adapter\Currency\CommandHandler;

use Currency;
use PrestaShop\PrestaShop\Core\Domain\Currency\Command\RefreshExchangeRatesCommand;
use PrestaShop\PrestaShop\Core\Domain\Currency\CommandHandler\RefreshExchangeRatesHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Currency\Exception\CannotRefreshExchangeRatesException;
use PrestaShop\PrestaShop\Core\Domain\Currency\Exception\CurrencyException;

/**
 * Class RefreshExchangeRatesHandler is responsible for refreshing currency exchange rates.
 *
 * @internal
 */
final class RefreshExchangeRatesHandler implements RefreshExchangeRatesHandlerInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws CurrencyException
     */
    public function handle(RefreshExchangeRatesCommand $command)
    {
        $error = Currency::refreshCurrencies();

        if ($error) {
            throw new CannotRefreshExchangeRatesException($error);
        }
    }
}
