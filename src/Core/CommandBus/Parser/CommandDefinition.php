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

namespace PrestaShop\PrestaShop\Core\CommandBus\Parser;

/**
 * Transfers commands and queries definition data
 */
class CommandDefinition
{
    /**
     * @var string
     */
    private $className;

    /**
     * @var string
     */
    private $commandType;

    /**
     * @var string
     */
    private $description;

    /**
     * @param string $className
     * @param string $commandType
     * @param string $description
     */
    public function __construct($className, $commandType, $description)
    {
        $this->className = $className;
        $this->commandType = $commandType;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return string
     */
    public function getCommandType()
    {
        return $this->commandType;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
