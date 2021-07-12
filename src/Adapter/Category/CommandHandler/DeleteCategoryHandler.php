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

namespace PrestaShop\PrestaShop\Adapter\Category\CommandHandler;

use Category;
use PrestaShop\PrestaShop\Core\Domain\Category\Command\DeleteCategoryCommand;
use PrestaShop\PrestaShop\Core\Domain\Category\CommandHandler\DeleteCategoryHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CannotDeleteRootCategoryForShopException;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\CategoryNotFoundException;
use PrestaShop\PrestaShop\Core\Domain\Category\Exception\FailedToDeleteCategoryException;

/**
 * Class DeleteCategoryHandler.
 */
final class DeleteCategoryHandler extends AbstractDeleteCategoryHandler implements DeleteCategoryHandlerInterface
{
    /**
     * {@inheritdoc}
     *
     * @throws CategoryNotFoundException
     * @throws CannotDeleteRootCategoryForShopException
     * @throws FailedToDeleteCategoryException
     */
    public function handle(DeleteCategoryCommand $command)
    {
        $categoryIdValue = $command->getCategoryId()->getValue();
        $category = new Category($categoryIdValue);

        if (!$category->id) {
            throw new CategoryNotFoundException($command->getCategoryId(), sprintf('Category with id %s cannot be found.', var_export($categoryIdValue, true)));
        }

        if ($category->isRootCategoryForAShop()) {
            throw new CannotDeleteRootCategoryForShopException(sprintf('Shop\'s root category with id %s cannot be deleted.', var_export($categoryIdValue, true)));
        }

        if (!$category->delete()) {
            throw new FailedToDeleteCategoryException(sprintf('Failed to delete category with id %s', var_export($categoryIdValue, true)));
        }

        $this->handleProductsUpdate((int) $category->id_parent, $command->getDeleteMode());
    }
}
