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

namespace PrestaShopBundle\Form\Admin\Type;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @deprecated 1.7.5, to be removed in 1.8
 */
class TextEmptyType extends AbstractTypeExtension implements DataTransformerInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this);
    }

    public function getExtendedType()
    {
        return 'Symfony\Component\Form\Extension\Core\Type\TextType';
    }

    public function transform($data)
    {
        return $data;
    }

    public function reverseTransform($data)
    {
        return empty($data) ? '' : $data;
    }
}
