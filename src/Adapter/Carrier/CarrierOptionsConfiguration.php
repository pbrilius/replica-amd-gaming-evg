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

namespace PrestaShop\PrestaShop\Adapter\Carrier;

use PrestaShop\PrestaShop\Adapter\Configuration;
use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;

/**
 * Class CarrierOptionsConfiguration is responsible for saving and loading Carrier Options configuration.
 */
class CarrierOptionsConfiguration implements DataConfigurationInterface
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * CarrierOptionsConfiguration constructor.
     *
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration()
    {
        return [
            'default_carrier' => $this->configuration->getInt('PS_CARRIER_DEFAULT'),
            'carrier_default_order_by' => $this->configuration->getInt('PS_CARRIER_DEFAULT_SORT'),
            'carrier_default_order_way' => $this->configuration->getInt('PS_CARRIER_DEFAULT_ORDER'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfiguration(array $configuration)
    {
        if ($this->validateConfiguration($configuration)) {
            $this->configuration->set('PS_CARRIER_DEFAULT', $configuration['default_carrier']);
            $this->configuration->set('PS_CARRIER_DEFAULT_SORT', $configuration['carrier_default_order_by']);
            $this->configuration->set('PS_CARRIER_DEFAULT_ORDER', $configuration['carrier_default_order_way']);
        }

        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function validateConfiguration(array $configuration)
    {
        return isset(
            $configuration['default_carrier'],
            $configuration['carrier_default_order_by'],
            $configuration['carrier_default_order_way']
        );
    }
}
