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

namespace PrestaShop\PrestaShop\Core\Cart;

class CartRuleCollection implements \Iterator
{
    /**
     * @var CartRuleData[]
     */
    protected $cartRules = [];
    protected $iteratorPosition = 0;

    public function addCartRule(CartRuleData $cartRule)
    {
        $this->cartRules[] = $cartRule;
    }

    public function rewind()
    {
        $this->iteratorPosition = 0;
    }

    /**
     * @return CartRuleData
     */
    public function current()
    {
        return $this->cartRules[$this->getKey($this->iteratorPosition)];
    }

    public function key()
    {
        return $this->getKey($this->iteratorPosition);
    }

    public function next()
    {
        ++$this->iteratorPosition;
    }

    public function valid()
    {
        return $this->getKey($this->iteratorPosition) !== null
               && array_key_exists(
                   $this->getKey($this->iteratorPosition),
                   $this->cartRules
               );
    }

    protected function getKey($iteratorPosition)
    {
        $keys = array_keys($this->cartRules);
        if (!isset($keys[$iteratorPosition])) {
            return null;
        } else {
            return $keys[$iteratorPosition];
        }
    }
}
