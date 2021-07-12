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

namespace PrestaShop\PrestaShop\Adapter\Feature;

use Combination;
use PrestaShop\PrestaShop\Adapter\Configuration;
use PrestaShop\PrestaShop\Core\Feature\FeatureInterface;

/**
 * This class manages Combination feature.
 */
class CombinationFeature implements FeatureInterface
{
    /**
     * @var Configuration
     */
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function isUsed()
    {
        return Combination::isCurrentlyUsed();
    }

    /**
     * {@inheritdoc}
     */
    public function isActive()
    {
        return Combination::isFeatureActive();
    }

    /**
     * {@inheritdoc}
     */
    public function enable()
    {
        $this->configuration->set('PS_COMBINATION_FEATURE_ACTIVE', true);
    }

    /**
     * {@inheritdoc}
     */
    public function disable()
    {
        $this->configuration->set('PS_COMBINATION_FEATURE_ACTIVE', false);
    }

    /**
     * {@inheritdoc}
     */
    public function update($status)
    {
        true === $status ? $this->enable() : $this->disable();
    }
}
