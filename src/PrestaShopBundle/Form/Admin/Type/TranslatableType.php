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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormErrorIterator;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class TranslatableType adds translatable inputs with custom inner type to forms.
 * Language selection uses a dropdown.
 */
class TranslatableType extends AbstractType
{
    /**
     * @var array List of enabled locales
     */
    private $enabledLocales;

    /**
     * @var array List of all available locales
     */
    private $availableLocales;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var bool indicates whether to save the selected form language or not
     */
    private $saveFormLocaleChoice;

    /**
     * @var string default form language ID
     */
    private $defaultFormLanguageId;

    /**
     * @var int default language of the shop, used as a fallback when default form language is not set
     */
    private $defaultShopLanguageId;

    /**
     * @param array $availableLocales
     * @param UrlGeneratorInterface $urlGenerator
     * @param bool $saveFormLocaleChoice
     * @param int $defaultFormLanguageId
     * @param int $defaultShopLanguageId
     */
    public function __construct(
        array $availableLocales,
        UrlGeneratorInterface $urlGenerator,
        $saveFormLocaleChoice,
        $defaultFormLanguageId,
        $defaultShopLanguageId
    ) {
        $this->enabledLocales = $this->filterEnableLocales($availableLocales);
        $this->availableLocales = $availableLocales;
        $this->urlGenerator = $urlGenerator;
        $this->saveFormLocaleChoice = $saveFormLocaleChoice;
        $this->defaultFormLanguageId = $defaultFormLanguageId;
        $this->defaultShopLanguageId = $defaultShopLanguageId;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['locales'] as $locale) {
            $typeOptions = $options['options'];
            $typeOptions['label'] = $locale['iso_code'];

            if (!isset($typeOptions['required'])) {
                $typeOptions['required'] = false;
            }

            $builder->add($locale['id_lang'], $options['type'], $typeOptions);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['locales'] = $options['locales'];
        $view->vars['default_locale'] = $this->getDefaultLocale($options['locales']);
        $view->vars['hide_locales'] = 1 >= count($options['locales']);

        if ($this->saveFormLocaleChoice) {
            $view->vars['change_form_language_url'] = $this->urlGenerator->generate(
                'admin_employees_change_form_language'
            );
        }

        $this->setErrorsByLocale($view, $form, $options['locales']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'type' => TextType::class,
            'options' => [],
            'error_bubbling' => false,
            'only_enabled_locales' => false,
            'locales' => function (Options $options) {
                return $options['only_enabled_locales'] ?
                    $this->enabledLocales :
                    $this->availableLocales
                ;
            },
        ]);

        $resolver->setAllowedTypes('locales', 'array');
        $resolver->setAllowedTypes('options', 'array');
        $resolver->setAllowedTypes('type', 'string');
        $resolver->setAllowedTypes('error_bubbling', 'bool');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'translatable';
    }

    /**
     * If there are more then one locale it gets nested errors and if found prepares the errors for usage in twig.
     * If there are only one error which is not assigned to the default language then the error is being localised.
     *
     * @param FormView $view
     * @param FormInterface $form
     * @param array $locales
     */
    private function setErrorsByLocale(FormView $view, FormInterface $form, array $locales)
    {
        if (count($locales) <= 1) {
            return;
        }

        $formErrors = $form->getErrors(true);

        if (empty($formErrors)) {
            return;
        }

        if (1 === count($formErrors)) {
            $errorByLocale = $this->getSingleTranslatableErrorExcludingDefaultLocale(
                $formErrors,
                $form,
                $locales
            );

            if (null !== $errorByLocale) {
                $view->vars['error_by_locale'] = $errorByLocale;
            }

            return;
        }

        $errorsByLocale = $this->getTranslatableErrors(
            $formErrors,
            $form,
            $locales
        );

        if (null !== $errorsByLocale) {
            $view->vars['errors_by_locale'] = $errorsByLocale;
        }
    }

    /**
     * Gets single error excluding the default locales error since for default locale a language name prefix is not
     * required.
     *
     * @param FormErrorIterator $formErrors
     * @param FormInterface $form
     * @param array $locales
     *
     * @return array|null
     */
    private function getSingleTranslatableErrorExcludingDefaultLocale(
        FormErrorIterator $formErrors,
        FormInterface $form,
        array $locales
    ) {
        $errorByLocale = null;
        $formError = $formErrors[0];
        $nonDefaultLanguageFormKey = null;
        $iteration = 0;

        foreach ($form as $formItem) {
            if (0 === $iteration) {
                ++$iteration;

                continue;
            }

            if ($this->doesErrorFormAndCurrentFormMatches($formError->getOrigin(), $formItem)) {
                $nonDefaultLanguageFormKey = $iteration;

                break;
            }

            ++$iteration;
        }

        if (isset($locales[$nonDefaultLanguageFormKey])) {
            $errorByLocale = [
                'locale_name' => $locales[$nonDefaultLanguageFormKey]['name'],
                'error_message' => $formError->getMessage(),
            ];
        }

        return $errorByLocale;
    }

    /**
     * Gets translatable errors ready for popover display and assigned to each language
     *
     * @param FormErrorIterator $formErrors
     * @param FormInterface $form
     * @param array $locales
     *
     * @return array|null
     */
    private function getTranslatableErrors(
        FormErrorIterator $formErrors,
        FormInterface $form,
        array $locales
    ) {
        $errorsByLocale = null;
        $iteration = 0;
        foreach ($form as $formItem) {
            $doesLocaleExistForInvalidForm = isset($locales[$iteration]) && !$formItem->isValid();

            if ($doesLocaleExistForInvalidForm) {
                foreach ($formErrors as $formError) {
                    if ($this->doesErrorFormAndCurrentFormMatches($formError->getOrigin(), $formItem)) {
                        $errorsByLocale[$locales[$iteration]['iso_code']] = [
                            'locale_name' => $locales[$iteration]['name'],
                            'error_message' => $formError->getMessage(),
                        ];
                    }
                }
            }

            ++$iteration;
        }

        return $errorsByLocale;
    }

    /**
     * Determines if the error form matches the given form. Used for mapping the locales for the form fields.
     *
     * @param FormInterface $errorForm
     * @param FormInterface $currentForm
     *
     * @return bool
     */
    private function doesErrorFormAndCurrentFormMatches(FormInterface $errorForm, FormInterface $currentForm)
    {
        return $errorForm === $currentForm;
    }

    /**
     * Get default locale.
     *
     * @param array $locales
     *
     * @return array
     */
    private function getDefaultLocale(array $locales)
    {
        if ($this->defaultFormLanguageId) {
            // Searching for a locale that matches default form language
            foreach ($locales as $locale) {
                if ($locale['id_lang'] == $this->defaultFormLanguageId) {
                    return $locale;
                }
            }
        }

        // Searching for locale that matches default shop language
        foreach ($locales as $locale) {
            if ($locale['id_lang'] == $this->defaultShopLanguageId) {
                return $locale;
            }
        }

        return reset($locales);
    }

    /**
     * Filters only enabled locales
     *
     * @param array $availableLocales
     *
     * @return array
     */
    private function filterEnableLocales(array $availableLocales)
    {
        $enabledLocales = [];

        foreach ($availableLocales as $locale) {
            if ($locale['active']) {
                $enabledLocales[] = $locale;
            }
        }

        return $enabledLocales;
    }
}
