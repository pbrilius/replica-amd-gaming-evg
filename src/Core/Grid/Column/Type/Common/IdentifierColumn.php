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

namespace PrestaShop\PrestaShop\Core\Grid\Column\Type\Common;

use PrestaShop\PrestaShop\Core\Grid\Column\AbstractColumn;
use PrestaShop\PrestaShop\Core\Grid\Column\Type\PreviewColumn;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Columns is used as identifier in grid (e.g. Product ID, Category ID & etc)
 */
final class IdentifierColumn extends AbstractColumn
{
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'identifier';
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired([
                'identifier_field',
            ])
            ->setDefaults([
                'sortable' => true,
                'with_bulk_field' => false,
                'bulk_field' => null,
                'preview' => null,
                'clickable' => true,
            ])
            ->setAllowedTypes('identifier_field', 'string')
            ->setAllowedTypes('sortable', 'bool')
            ->setAllowedTypes('with_bulk_field', 'bool')
            ->setAllowedTypes('bulk_field', ['string', 'null'])
            ->setAllowedTypes('clickable', 'bool')
            ->setAllowedValues('preview', function ($previewColumn) {
                return $previewColumn instanceof PreviewColumn || $previewColumn === null;
            })
        ;
    }
}
