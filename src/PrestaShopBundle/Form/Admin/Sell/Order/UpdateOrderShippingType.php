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

namespace PrestaShopBundle\Form\Admin\Sell\Order;

use PrestaShop\PrestaShop\Core\Form\ConfigurableFormChoiceProviderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateOrderShippingType extends AbstractType
{
    /**
     * @var ConfigurableFormChoiceProviderInterface
     */
    private $carrierForOrderChoiceProvider;

    /**
     * @param ConfigurableFormChoiceProviderInterface $carrierForOrderChoiceProvider
     */
    public function __construct(ConfigurableFormChoiceProviderInterface $carrierForOrderChoiceProvider)
    {
        $this->carrierForOrderChoiceProvider = $carrierForOrderChoiceProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('new_carrier_id', ChoiceType::class, [
                'choices' => $this->carrierForOrderChoiceProvider->getChoices([
                    'order_id' => $options['order_id'],
                ]),
            ])
            ->add('current_order_carrier_id', HiddenType::class)
            ->add('tracking_number', TextType::class, [
                'required' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setRequired([
                'order_id',
            ])
            ->setAllowedTypes('order_id', 'int')
        ;
    }
}
