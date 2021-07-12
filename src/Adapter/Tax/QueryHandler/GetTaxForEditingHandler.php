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

namespace PrestaShop\PrestaShop\Adapter\Tax\QueryHandler;

use PrestaShop\PrestaShop\Adapter\Tax\AbstractTaxHandler;
use PrestaShop\PrestaShop\Core\Domain\Tax\Query\GetTaxForEditing;
use PrestaShop\PrestaShop\Core\Domain\Tax\QueryHandler\GetTaxForEditingHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Tax\QueryResult\EditableTax;

/**
 * Handles query which gets tax for editing
 */
final class GetTaxForEditingHandler extends AbstractTaxHandler implements GetTaxForEditingHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function handle(GetTaxForEditing $query)
    {
        $tax = $this->getTax($query->getTaxId());

        return new EditableTax(
            $query->getTaxId(),
            $tax->name,
            (float) $tax->rate,
            (bool) $tax->active
        );
    }
}
