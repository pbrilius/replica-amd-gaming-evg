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

namespace PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataProvider;

use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;
use PrestaShop\PrestaShop\Core\Domain\Category\Query\GetCategoryForEditing;
use PrestaShop\PrestaShop\Core\Domain\Category\QueryResult\EditableCategory;
use PrestaShop\PrestaShop\Core\Group\Provider\DefaultGroupsProviderInterface;

/**
 * Provides data for category add/edit category forms
 */
final class CategoryFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var CommandBusInterface
     */
    private $queryBus;

    /**
     * @var int
     */
    private $contextShopId;

    /**
     * @var int
     */
    private $contextShopRootCategoryId;

    /**
     * @var DefaultGroupsProviderInterface
     */
    private $defaultGroupsProvider;

    /**
     * @param CommandBusInterface $queryBus
     * @param int $contextShopId
     * @param int $contextShopRootCategoryId
     * @param DefaultGroupsProviderInterface $defaultGroupsProvider
     */
    public function __construct(
        CommandBusInterface $queryBus,
        $contextShopId,
        $contextShopRootCategoryId,
        DefaultGroupsProviderInterface $defaultGroupsProvider
    ) {
        $this->queryBus = $queryBus;
        $this->contextShopId = $contextShopId;
        $this->contextShopRootCategoryId = $contextShopRootCategoryId;
        $this->defaultGroupsProvider = $defaultGroupsProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getData($categoryId)
    {
        /** @var EditableCategory $editableCategory */
        $editableCategory = $this->queryBus->handle(new GetCategoryForEditing($categoryId));

        return [
            'name' => $editableCategory->getName(),
            'active' => $editableCategory->isActive(),
            'id_parent' => $editableCategory->getParentId(),
            'description' => $editableCategory->getDescription(),
            'meta_title' => $editableCategory->getMetaTitle(),
            'meta_description' => $editableCategory->getMetaDescription(),
            'meta_keyword' => $editableCategory->getMetaKeywords(),
            'link_rewrite' => $editableCategory->getLinkRewrite(),
            'group_association' => $editableCategory->getGroupAssociationIds(),
            'shop_association' => $editableCategory->getShopAssociationIds(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultData()
    {
        $defaultGroups = $this->defaultGroupsProvider->getGroups();

        return [
            'id_parent' => $this->contextShopRootCategoryId,
            'group_association' => [
                $defaultGroups->getVisitorsGroup()->getId(),
                $defaultGroups->getGuestsGroup()->getId(),
                $defaultGroups->getCustomersGroup()->getId(),
            ],
            'shop_association' => $this->contextShopId,
            'active' => true,
        ];
    }
}
