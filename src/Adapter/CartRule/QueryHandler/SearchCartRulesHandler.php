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

namespace PrestaShop\PrestaShop\Adapter\CartRule\QueryHandler;

use CartRule;
use PrestaShop\PrestaShop\Core\Domain\CartRule\Query\SearchCartRules;
use PrestaShop\PrestaShop\Core\Domain\CartRule\QueryHandler\SearchCartRulesHandlerInterface;
use PrestaShop\PrestaShop\Core\Domain\CartRule\QueryResult\FoundCartRule;

/**
 * Searches for cart rules by search phrase using legacy object model
 */
final class SearchCartRulesHandler implements SearchCartRulesHandlerInterface
{
    /**
     * @var int
     */
    private $contextLangId;

    /**
     * @param int $contextLangId
     */
    public function __construct(int $contextLangId)
    {
        $this->contextLangId = $contextLangId;
    }

    /**
     * @param SearchCartRules $query
     *
     * @return FoundCartRule[]
     */
    public function handle(SearchCartRules $query): array
    {
        $searchPhrase = $query->getSearchPhrase();
        $foundCartRules = [];
        $cartRules = CartRule::getCartsRuleByCode($searchPhrase, $this->contextLangId, true);

        foreach ($cartRules as $cartRule) {
            $foundCartRules[] = new FoundCartRule(
                (int) $cartRule['id_cart_rule'],
                $cartRule['name'],
                $cartRule['code']
            );
        }

        return $foundCartRules;
    }
}
