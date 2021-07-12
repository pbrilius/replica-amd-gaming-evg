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

namespace PrestaShop\PrestaShop\Core\Team\Employee\Configuration;

use PrestaShop\PrestaShop\Core\Feature\FeatureInterface;
use PrestaShop\PrestaShop\Core\Multistore\MultistoreContextCheckerInterface;

/**
 * Class OptionsChecker checks if employee options can be changed depending on current shop context.
 */
final class OptionsChecker implements OptionsCheckerInterface
{
    /**
     * @var FeatureInterface
     */
    private $multistoreFeature;

    /**
     * @var MultistoreContextCheckerInterface
     */
    private $multistoreContextChecker;

    /**
     * @param FeatureInterface $multistoreFeature
     * @param MultistoreContextCheckerInterface $multistoreContextChecker
     */
    public function __construct(
        FeatureInterface $multistoreFeature,
        MultistoreContextCheckerInterface $multistoreContextChecker
    ) {
        $this->multistoreFeature = $multistoreFeature;
        $this->multistoreContextChecker = $multistoreContextChecker;
    }

    /**
     * {@inheritdoc}
     */
    public function canBeChanged()
    {
        if (!$this->multistoreFeature->isUsed()
            && $this->multistoreContextChecker->isSingleShopContext()
        ) {
            return true;
        }

        return $this->multistoreContextChecker->isAllShopContext();
    }
}
