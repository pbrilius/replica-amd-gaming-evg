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
use PrestaShop\PrestaShop\Core\Session\SessionInterface;

class CustomerSessionCore extends ObjectModel implements SessionInterface
{
    public $id;

    /** @var Id Customer */
    public $id_customer;

    /** @var string Token */
    public $token;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'customer_session',
        'primary' => 'id_customer_session',
        'fields' => [
            'id_customer' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true],
            'token' => ['type' => self::TYPE_STRING, 'validate' => 'isSha1', 'size' => 40, 'copy_post' => false],
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setUserId($idCustomer)
    {
        $this->id_customer = (int) $idCustomer;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserId()
    {
        return (int) $this->id_customer;
    }

    /**
     * {@inheritdoc}
     */
    public function setToken($token)
    {
        $this->token = (string) $token;
    }

    /**
     * {@inheritdoc}
     */
    public function getToken()
    {
        return $this->token;
    }
}
