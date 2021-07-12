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

namespace PrestaShop\PrestaShop\Core\Grid\Filter;

use PrestaShop\PrestaShop\Core\Grid\Definition\GridDefinitionInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Decorates grid filter form action.
 */
final class FilterFormFactoryFormActionDecorator implements GridFilterFormFactoryInterface
{
    /**
     * @var GridFilterFormFactoryInterface
     */
    private $delegate;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var string
     */
    private $formActionRoute;

    /**
     * @param GridFilterFormFactoryInterface $delegate
     * @param UrlGeneratorInterface $urlGenerator
     * @param string $formActionRoute will change the form action of filters form to this
     */
    public function __construct(
        GridFilterFormFactoryInterface $delegate,
        UrlGeneratorInterface $urlGenerator,
        string $formActionRoute
    ) {
        $this->delegate = $delegate;
        $this->urlGenerator = $urlGenerator;
        $this->formActionRoute = $formActionRoute;
    }

    /**
     * {@inheritdoc}
     */
    public function create(GridDefinitionInterface $definition)
    {
        $filterForm = $this->delegate->create($definition);

        $formBuilder = $filterForm->getConfig()->getFormFactory()->createNamedBuilder(
            $definition->getId(),
            FormType::class
        );

        /** @var FormInterface $formItem */
        foreach ($filterForm as $formItem) {
            $formBuilder->add(
                $formItem->getName(),
                get_class($formItem->getConfig()->getType()->getInnerType()),
                $formItem->getConfig()->getOptions()
            );
        }

        $formBuilder->setAction(
            $this->urlGenerator->generate($this->formActionRoute)
        );

        return $formBuilder->getForm();
    }
}
