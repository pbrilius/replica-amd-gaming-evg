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

namespace PrestaShopBundle\Form\Admin\Sell\Catalog;

use PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints\TypedRegex;
use PrestaShopBundle\Form\Admin\Type\ShopChoiceTreeType;
use PrestaShopBundle\Form\Admin\Type\TranslatableType;
use PrestaShopBundle\Translation\TranslatorAwareTrait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Type that builds a product feature add/edit form.
 */
class FeatureType extends AbstractType
{
    use TranslatorAwareTrait;

    /**
     * @var bool
     */
    private $isMultistoreFeatureActive;

    /**
     * @param bool $isMultistoreFeatureActive
     */
    public function __construct($isMultistoreFeatureActive)
    {
        $this->isMultistoreFeatureActive = $isMultistoreFeatureActive;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TranslatableType::class, [
            'type' => TextType::class,
            'options' => [
                'constraints' => [
                    new TypedRegex([
                        'type' => 'generic_name',
                    ]),
                ],
            ],
        ]);

        if ($this->isMultistoreFeatureActive) {
            $builder->add('shop_association', ShopChoiceTreeType::class);
        }
    }
}
