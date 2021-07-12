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

namespace PrestaShopBundle\Form\Admin\Configure\ShopParameters\General;

use PrestaShop\PrestaShop\Adapter\Preferences\PreferencesConfiguration;
use PrestaShop\PrestaShop\Core\Form\FormDataProviderInterface;

/**
 * This class is responsible of managing the data manipulated using forms
 * in "Configure > Shop Parameters > General" page.
 */
final class PreferencesFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var PreferencesConfiguration
     */
    private $preferencesConfiguration;

    public function __construct(PreferencesConfiguration $preferencesConfiguration)
    {
        $this->preferencesConfiguration = $preferencesConfiguration;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return [
            'general' => $this->preferencesConfiguration->getConfiguration(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data)
    {
        return $this->preferencesConfiguration->updateConfiguration($data['general']);
    }
}
