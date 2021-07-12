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

use PrestaShop\PrestaShop\Core\Form\ConfigurableFormChoiceProviderInterface;
use PrestaShop\PrestaShop\Core\Grid\Column\AbstractColumn;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Displays choices in the grid.
 */
final class ChoiceColumn extends AbstractColumn
{
    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return 'choice';
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setRequired(
                [
                    'choice_provider',
                    'field',
                    'route',
                ]
            )
            ->setDefaults([
                'color_field' => '',
                'record_route_params' => [],
            ])
            ->setAllowedTypes('choice_provider', ConfigurableFormChoiceProviderInterface::class)
            ->setAllowedTypes('field', ['string', 'int', 'bool'])
            ->setAllowedTypes('color_field', 'string')
            ->setAllowedTypes('route', 'string')
            ->setAllowedTypes('record_route_params', 'array')
        ;
    }
}
