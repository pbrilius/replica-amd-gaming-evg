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

namespace PrestaShopBundle\Form\Admin\Improve\Design\Theme;

use PrestaShopBundle\Translation\TranslatorAwareTrait;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

/**
 * Class ImportThemeType
 */
class ImportThemeType extends AbstractType
{
    use TranslatorAwareTrait;

    /**
     * @var array
     */
    private $themeZipsChoices;

    /**
     * @param array $themeZipsChoices
     */
    public function __construct(array $themeZipsChoices)
    {
        $this->themeZipsChoices = $themeZipsChoices;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('import_from_computer', FileType::class, [
                'required' => false,
                'constraints' => new File([
                    'mimeTypes' => 'application/zip',
                    'mimeTypesMessage' => $this->trans('Invalid file format.', [], 'Admin.Design.Notification'),
                ]),
            ])
            ->add('import_from_web', UrlType::class, [
                'required' => false,
            ])
            ->add('import_from_ftp', ChoiceType::class, [
                'required' => false,
                'placeholder' => '-',
                'choices' => $this->themeZipsChoices,
                'translation_domain' => false,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'post_max_size_message' => $this->trans(
                'The uploaded file is too large.',
                [],
                'Admin.Notifications.Error'
            ),
        ]);
    }
}
