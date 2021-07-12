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
use PrestaShopBundle\Entity\Repository\TimezoneRepository;

/**
 * Class TimezoneByNameChoiceProvider provides timezone choices with name values.
 */
final class TimezoneByNameChoiceProvider implements FormChoiceProviderInterface
{
    /**
     * @var TimezoneRepository
     */
    private $timezoneRepository;

    /**
     * @param TimezoneRepository $timezoneRepository
     */
    public function __construct(TimezoneRepository $timezoneRepository)
    {
        $this->timezoneRepository = $timezoneRepository;
    }

    /**
     * Get timezone choices.
     *
     * @return array
     */
    public function getChoices()
    {
        $timezones = $this->timezoneRepository->findAll();
        $choices = [];

        foreach ($timezones as $timezone) {
            $choices[$timezone['name']] = $timezone['name'];
        }

        return $choices;
    }
}
