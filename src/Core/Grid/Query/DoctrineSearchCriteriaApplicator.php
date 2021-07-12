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

namespace PrestaShop\PrestaShop\Core\Grid\Query;

use Doctrine\DBAL\Query\QueryBuilder;
use PrestaShop\PrestaShop\Core\Grid\Search\SearchCriteriaInterface;

/**
 * Class DoctrineSearchCriteriaApplicator applies search criteria to doctrine query builder.
 */
final class DoctrineSearchCriteriaApplicator implements DoctrineSearchCriteriaApplicatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function applyPagination(SearchCriteriaInterface $searchCriteria, QueryBuilder $queryBuilder)
    {
        if (null !== $searchCriteria->getLimit()) {
            $queryBuilder->setMaxResults($searchCriteria->getLimit());
        }

        if (null !== $searchCriteria->getOffset()) {
            $queryBuilder->setFirstResult($searchCriteria->getOffset());
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function applySorting(SearchCriteriaInterface $searchCriteria, QueryBuilder $queryBuilder)
    {
        if (null !== $searchCriteria->getOrderBy() && null !== $searchCriteria->getOrderWay()) {
            $queryBuilder->orderBy(
                $searchCriteria->getOrderBy(),
                $searchCriteria->getOrderWay()
            );
        }

        return $this;
    }
}
