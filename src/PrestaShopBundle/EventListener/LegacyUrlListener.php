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

namespace PrestaShopBundle\EventListener;

use PrestaShop\PrestaShop\Core\Exception\CoreException;
use PrestaShopBundle\Routing\Converter\LegacyUrlConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Converts any legacy url into a migrated Symfony url (if it exists) and redirect to it.
 */
class LegacyUrlListener
{
    /**
     * @var LegacyUrlConverter
     */
    private $converter;

    /**
     * @param LegacyUrlConverter $converter
     */
    public function __construct(LegacyUrlConverter $converter)
    {
        $this->converter = $converter;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        try {
            $convertedUrl = $this->converter->convertByRequest($event->getRequest());
        } catch (CoreException $e) {
            return;
        }

        $event->setResponse(new RedirectResponse($convertedUrl));
    }
}
