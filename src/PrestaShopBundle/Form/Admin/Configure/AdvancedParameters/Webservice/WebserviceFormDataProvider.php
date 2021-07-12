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

namespace PrestaShopBundle\Form\Admin\Configure\AdvancedParameters\Webservice;

use PrestaShop\PrestaShop\Adapter\Webservice\WebserviceConfiguration;
use PrestaShop\PrestaShop\Core\Form\FormDataProviderInterface;

/**
 * This class is responsible of managing the data manipulated using forms
 * in "Configure > Advanced Parameters > Webservice" page.
 */
final class WebserviceFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var WebserviceConfiguration
     */
    private $webserviceConfiguration;

    /**
     * @param WebserviceConfiguration $webserviceConfiguration
     */
    public function __construct(WebserviceConfiguration $webserviceConfiguration)
    {
        $this->webserviceConfiguration = $webserviceConfiguration;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return [
            'webservice_configuration' => $this->webserviceConfiguration->getConfiguration(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function setData(array $data)
    {
        return $this->webserviceConfiguration->updateConfiguration($data['webservice_configuration']);
    }
}
