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

namespace PrestaShop\PrestaShop\Core\Hook;

/**
 * Class RenderingHook defines rendered hook.
 */
final class RenderedHook implements RenderedHookInterface
{
    /**
     * @var HookInterface
     */
    private $hook;

    /**
     * @var array ['module_name' => 'rendered_content', ...]
     */
    private $content;

    /**
     * @param HookInterface $hook
     * @param array $content
     */
    public function __construct(HookInterface $hook, array $content = [])
    {
        $this->hook = $hook;
        $this->content = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function getHook()
    {
        return $this->hook;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function outputContent()
    {
        return implode('', $this->content);
    }
}
