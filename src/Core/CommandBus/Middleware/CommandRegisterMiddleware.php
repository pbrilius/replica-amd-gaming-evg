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

namespace PrestaShop\PrestaShop\Core\CommandBus\Middleware;

use League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor;
use League\Tactician\Handler\Locator\HandlerLocator;
use League\Tactician\Middleware;
use PrestaShop\PrestaShop\Core\CommandBus\ExecutedCommandRegistry;

/**
 * Registers every command that was executed in system
 */
final class CommandRegisterMiddleware implements Middleware
{
    /**
     * @var HandlerLocator
     */
    private $handlerLocator;

    /**
     * @var CommandNameExtractor
     */
    private $commandNameExtractor;

    /**
     * @var ExecutedCommandRegistry
     */
    private $executedCommandRegistry;

    /**
     * @param HandlerLocator $handlerLocator
     * @param CommandNameExtractor $commandNameExtractor
     * @param ExecutedCommandRegistry $executedCommandRegistry
     */
    public function __construct(
        HandlerLocator $handlerLocator,
        CommandNameExtractor $commandNameExtractor,
        ExecutedCommandRegistry $executedCommandRegistry
    ) {
        $this->handlerLocator = $handlerLocator;
        $this->commandNameExtractor = $commandNameExtractor;
        $this->executedCommandRegistry = $executedCommandRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        $commandName = $this->commandNameExtractor->extract($command);
        $handler = $this->handlerLocator->getHandlerForCommand($commandName);

        $this->executedCommandRegistry->register($command, $handler);

        return $next($command);
    }
}
