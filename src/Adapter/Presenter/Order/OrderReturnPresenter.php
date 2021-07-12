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

namespace PrestaShop\PrestaShop\Adapter\Presenter\Order;

use Exception;
use Link;
use PrestaShop\PrestaShop\Adapter\Presenter\PresenterInterface;

class OrderReturnPresenter implements PresenterInterface
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * @var Link
     */
    private $link;

    /**
     * OrderReturnPresenter constructor.
     *
     * @param $prefix
     * @param Link $link
     */
    public function __construct($prefix, Link $link)
    {
        $this->prefix = $prefix;
        $this->link = $link;
    }

    /**
     * @param $orderReturn
     *
     * @return OrderReturnLazyArray
     *
     * @throws \ReflectionException
     */
    public function present($orderReturn)
    {
        if (!is_array($orderReturn)) {
            throw new Exception('orderReturnPresenter can only present order_return passed as array');
        }

        return new OrderReturnLazyArray($this->prefix, $this->link, $orderReturn);
    }
}
