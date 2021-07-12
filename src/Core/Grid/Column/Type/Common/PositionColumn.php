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
use PrestaShop\PrestaShop\Core\Grid\Position\GridPositionUpdater;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PositionColumn defines a position column used to sort elements in a grid,
 * it is associated to a special template, and works well with the PositionExtension
 * javascript extension and the GridPositionUpdater service.
 *
 * @see admin-dev/themes/new-theme/js/components/grid/extension/position-extension.js
 * @see GridPositionUpdater
 */
final class PositionColumn extends AbstractColumn
{
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'position';
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired([
                'id_field',
                'position_field',
                'update_route',
            ])
            ->setDefaults([
                'sortable' => true,
                'update_method' => 'GET',
                'record_route_params' => [],
                'clickable' => true,
            ])
            ->setAllowedTypes('id_field', 'string')
            ->setAllowedTypes('position_field', 'string')
            ->setAllowedTypes('update_route', 'string')
            ->setAllowedTypes('sortable', 'bool')
            ->setAllowedTypes('update_method', 'string')
            ->setAllowedTypes('record_route_params', ['array'])
            ->setAllowedTypes('clickable', 'bool')
            ->setAllowedValues('update_method', ['GET', 'POST']);
    }
}
