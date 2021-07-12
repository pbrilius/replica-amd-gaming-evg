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

namespace PrestaShopBundle\Form\Admin\Improve\Shipping\Preferences;

use PrestaShop\PrestaShop\Adapter\Configuration;
use PrestaShop\PrestaShop\Adapter\Currency\CurrencyDataProvider;
use PrestaShopBundle\Form\Admin\Type\MoneyWithSuffixType;
use PrestaShopBundle\Form\Admin\Type\TextWithUnitType;
use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class generates "Handling" form
 * in "Improve > Shipping > Preferences" page.
 */
class HandlingType extends TranslatorAwareType
{
    /**
     * @var CurrencyDataProvider
     */
    private $currencyDataProvider;

    public function __construct(
        TranslatorInterface $translator,
        array $locales,
        CurrencyDataProvider $currencyDataProvider
    ) {
        parent::__construct($translator, $locales);

        $this->currencyDataProvider = $currencyDataProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var Configuration $configuration */
        $configuration = $this->getConfiguration();
        $defaultCurrencyId = $configuration->getInt('PS_CURRENCY_DEFAULT');
        $defaultCurrency = $this->currencyDataProvider->getCurrencyById($defaultCurrencyId);
        $weightUnit = $configuration->get('PS_WEIGHT_UNIT');

        $builder
            ->add('shipping_handling_charges', MoneyWithSuffixType::class, [
                'currency' => $defaultCurrency->iso_code,
                'suffix' => $this->trans('(tax excl.)', 'Admin.Global'),
                'required' => false,
                'empty_data' => '0',
            ])
            ->add('free_shipping_price', MoneyType::class, [
                'currency' => $defaultCurrency->iso_code,
                'required' => false,
                'empty_data' => '0',
            ])
            ->add('free_shipping_weight', TextWithUnitType::class, [
                'unit' => $weightUnit,
                'required' => false,
                'empty_data' => '0',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => 'Admin.Shipping.Feature',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'shipping_preferences_handling_block';
    }
}
