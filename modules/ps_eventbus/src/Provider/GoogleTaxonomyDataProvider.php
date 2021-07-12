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


namespace PrestaShop\Module\PsEventbus\Provider;

use Context;
use PrestaShop\Module\PsEventbus\Repository\GoogleTaxonomyRepository;

class GoogleTaxonomyDataProvider implements PaginatedApiDataProviderInterface
{
    /**
     * @var GoogleTaxonomyRepository
     */
    private $googleTaxonomyRepository;
    /**
     * @var Context
     */
    private $context;

    public function __construct(GoogleTaxonomyRepository $googleTaxonomyRepository, Context $context)
    {
        $this->googleTaxonomyRepository = $googleTaxonomyRepository;
        $this->context = $context;
    }

    public function getFormattedData($offset, $limit, $langIso)
    {
        $data = $this->googleTaxonomyRepository->getTaxonomyCategories($offset, $limit, $this->context->shop->id);

        if (!is_array($data)) {
            return [];
        }

        return array_map(function ($googleTaxonomy) {
            $uniqueId = "{$googleTaxonomy['id_category']}-{$googleTaxonomy['id_category']}";
            $googleTaxonomy['taxonomy_id'] = $uniqueId;

            return [
                'id' => $uniqueId,
                'collection' => 'taxonomies',
                'properties' => $googleTaxonomy,
            ];
        }, $data);
    }

    public function getRemainingObjectsCount($offset, $langIso)
    {
        return (int) $this->googleTaxonomyRepository->getRemainingTaxonomyRepositories($offset, $this->context->shop->id);
    }

    public function getFormattedDataIncremental($limit, $langIso, $objectIds)
    {
        return [];
    }
}
