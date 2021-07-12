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

namespace PrestaShop\PrestaShop\Core\Form\ChoiceProvider;

use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class CanonicalRedirectTypeChoiceProvider is responsible for providing choices for
 * redirect to the canonical URL form field selection.
 */
final class CanonicalRedirectTypeChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * CanonicalRedirectTypeChoiceProvider constructor.
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function getChoices()
    {
        $noRedirectionMessage = $this->translator->trans(
            'No redirection (you may have duplicate content issues)',
            [],
            'Admin.Shopparameters.Feature'
        );

        $movedTemporaryMessage = $this->translator->trans(
            '302 Moved Temporarily (recommended while setting up your store)',
            [],
            'Admin.Shopparameters.Feature'
        );

        $movedPermanentlyMessage = $this->translator->trans(
            '301 Moved Permanently (recommended once you have gone live)',
            [],
            'Admin.Shopparameters.Feature'
        );

        return [
            $noRedirectionMessage => 0,
            $movedTemporaryMessage => 1,
            $movedPermanentlyMessage => 2,
        ];
    }
}
