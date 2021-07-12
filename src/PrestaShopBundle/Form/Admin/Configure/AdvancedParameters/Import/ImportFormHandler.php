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

namespace PrestaShopBundle\Form\Admin\Configure\AdvancedParameters\Import;

use PrestaShop\PrestaShop\Core\Hook\HookDispatcherInterface;
use PrestaShop\PrestaShop\Core\Import\Configuration\ImportConfigInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class ImportFormHandler defines a form handler of import forms.
 */
class ImportFormHandler implements ImportFormHandlerInterface
{
    /**
     * Form builder.
     *
     * @var FormBuilderInterface
     */
    private $formBuilder;

    /**
     * Hook dispatcher.
     *
     * @var HookDispatcherInterface
     */
    private $hookDispatcher;

    /**
     * @var ImportFormDataProviderInterface
     */
    private $formDataProvider;
    /**
     * @var string
     */
    private $hookName;

    /**
     * @param FormBuilderInterface $formBuilder
     * @param HookDispatcherInterface $hookDispatcher
     * @param ImportFormDataProviderInterface $formDataProvider
     * @param string $hookName
     */
    public function __construct(
        FormBuilderInterface $formBuilder,
        HookDispatcherInterface $hookDispatcher,
        ImportFormDataProviderInterface $formDataProvider,
        $hookName
    ) {
        $this->formBuilder = $formBuilder;
        $this->hookDispatcher = $hookDispatcher;
        $this->formDataProvider = $formDataProvider;
        $this->hookName = $hookName;
    }

    /**
     * {@inheritdoc}
     */
    public function getForm(ImportConfigInterface $importConfig)
    {
        $this->formBuilder->setData($this->formDataProvider->getData($importConfig));
        $this->hookDispatcher->dispatchWithParameters(
            "action{$this->hookName}Form",
            [
                'form_builder' => $this->formBuilder,
            ]
        );

        return $this->formBuilder->getForm();
    }

    /**
     * {@inheritdoc}
     */
    public function save(array $data)
    {
        $errors = $this->formDataProvider->setData($data);

        $this->hookDispatcher->dispatchWithParameters(
            "action{$this->hookName}Save",
            [
                'errors' => &$errors,
                'form_data' => $data,
            ]
        );

        return $errors;
    }
}
