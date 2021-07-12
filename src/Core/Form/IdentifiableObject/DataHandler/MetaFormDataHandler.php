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

namespace PrestaShop\PrestaShop\Core\Form\IdentifiableObject\DataHandler;

use PrestaShop\PrestaShop\Core\CommandBus\CommandBusInterface;
use PrestaShop\PrestaShop\Core\Domain\Meta\Command\AddMetaCommand;
use PrestaShop\PrestaShop\Core\Domain\Meta\Command\EditMetaCommand;
use PrestaShop\PrestaShop\Core\Domain\Meta\Exception\MetaException;
use PrestaShop\PrestaShop\Core\Domain\Meta\ValueObject\MetaId;

/**
 * Class MetaFormDataHandler is responsible to handle creation and update logic for meta form.
 */
final class MetaFormDataHandler implements FormDataHandlerInterface
{
    /**
     * @var CommandBusInterface
     */
    private $commandBus;

    /**
     * @param CommandBusInterface $commandBus
     */
    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * {@inheritdoc}
     *
     * @throws MetaException
     */
    public function create(array $data)
    {
        $addMetaCommand = (new AddMetaCommand($data['page_name']))
            ->setLocalisedPageTitle($data['page_title'])
            ->setLocalisedMetaDescription($data['meta_description'])
            ->setLocalisedMetaKeywords($data['meta_keywords'])
            ->setLocalisedRewriteUrls($data['url_rewrite'])
        ;

        /** @var MetaId $metaId */
        $metaId = $this->commandBus->handle($addMetaCommand);

        return $metaId->getValue();
    }

    /**
     * {@inheritdoc}
     *
     * @throws MetaException
     */
    public function update($metaId, array $data)
    {
        $editMetaCommand = (new EditMetaCommand((int) $metaId))
            ->setPageName($data['page_name'])
            ->setLocalisedPageTitles($data['page_title'])
            ->setLocalisedMetaDescriptions($data['meta_description'])
            ->setLocalisedMetaKeywords($data['meta_keywords'])
            ->setLocalisedRewriteUrls($data['url_rewrite'])
        ;

        $this->commandBus->handle($editMetaCommand);
    }
}
