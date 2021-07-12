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

namespace PrestaShop\PrestaShop\Core\Domain\Feature\QueryResult;

use PrestaShop\PrestaShop\Core\Domain\Feature\ValueObject\FeatureId;

/**
 * Stores feature data that's needed for editing.
 */
class EditableFeature
{
    /**
     * @var FeatureId
     */
    private $featureId;

    /**
     * @var string[]
     */
    private $name;

    /**
     * @var int[]
     */
    private $shopAssociationIds;

    /**
     * @param FeatureId $featureId
     * @param string[] $name
     * @param int[] $shopAssociationIds
     */
    public function __construct(FeatureId $featureId, array $name, array $shopAssociationIds)
    {
        $this->featureId = $featureId;
        $this->name = $name;
        $this->shopAssociationIds = $shopAssociationIds;
    }

    /**
     * @return FeatureId
     */
    public function getFeatureId()
    {
        return $this->featureId;
    }

    /**
     * @return string[]
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int[]
     */
    public function getShopAssociationIds()
    {
        return $this->shopAssociationIds;
    }
}
