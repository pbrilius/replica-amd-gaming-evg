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
use PrestaShop\PrestaShop\Core\Domain\Meta\Exception\MetaException;
use PrestaShop\PrestaShop\Core\Domain\Meta\Query\GetMetaForEditing;
use PrestaShop\PrestaShop\Core\Domain\Meta\QueryResult\EditableMeta;

/**
 * Class MetaFormDataProvider is responsible for providing required data for meta form.
 */
final class MetaFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var CommandBusInterface
     */
    private $queryBus;

    public function __construct(CommandBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * {@inheritdoc}
     *
     * @throws MetaException
     */
    public function getData($metaId)
    {
        /** @var EditableMeta $result */
        $result = $this->queryBus->handle(new GetMetaForEditing((int) $metaId));

        return [
            'page_name' => $result->getPageName()->getValue(),
            'page_title' => $result->getLocalisedPageTitles(),
            'meta_description' => $result->getLocalisedMetaDescriptions(),
            'meta_keywords' => $result->getLocalisedMetaKeywords(),
            'url_rewrite' => $result->getLocalisedUrlRewrites(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultData()
    {
        return null;
    }
}
