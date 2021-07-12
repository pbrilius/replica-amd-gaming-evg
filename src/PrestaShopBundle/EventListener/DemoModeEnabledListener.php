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

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Util\ClassUtils;
use PrestaShopBundle\Security\Annotation\DemoRestricted;
use ReflectionClass;
use ReflectionObject;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Allow a redirection to the right url when using BetterSecurity annotation.
 */
class DemoModeEnabledListener
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * @var bool
     */
    private $isDemoModeEnabled;

    /**
     * DemoModeEnabledListener constructor.
     *
     * @param RouterInterface $router
     * @param TranslatorInterface $translator
     * @param SessionInterface $session
     * @param Reader $annotationReader
     * @param $isDemoModeEnabled
     */
    public function __construct(
        RouterInterface $router,
        TranslatorInterface $translator,
        SessionInterface $session,
        Reader $annotationReader,
        $isDemoModeEnabled
    ) {
        $this->router = $router;
        $this->translator = $translator;
        $this->session = $session;
        $this->annotationReader = $annotationReader;
        $this->isDemoModeEnabled = $isDemoModeEnabled;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        if (!$this->isDemoModeEnabled
            || !$event->isMasterRequest()
        ) {
            return;
        }

        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        list($controllerObject, $methodName) = $controller;
        $demoRestricted = $this->getAnnotation($controllerObject, $methodName);

        if (!$demoRestricted instanceof DemoRestricted) {
            return;
        }

        $this->showNotificationMessage($demoRestricted);

        $routeParametersToKeep = $this->getQueryParamsFromRequestQuery(
            $demoRestricted->getRedirectQueryParamsToKeep(),
            $event->getRequest()
        );

        $url = $this->router->generate($demoRestricted->getRedirectRoute(), $routeParametersToKeep);

        $event->setController(function () use ($url) {
            return new RedirectResponse($url);
        });
    }

    /**
     * Send an error message when redirected, will only work on migrated pages.
     *
     * @param DemoRestricted $demoRestricted
     */
    private function showNotificationMessage(DemoRestricted $demoRestricted)
    {
        $this->session->getFlashBag()->add(
            'error',
            $this->translator->trans(
                $demoRestricted->getMessage(),
                [],
                $demoRestricted->getDomain()
            )
        );
    }

    /**
     * Retrieve DemoRestricted Annotation.
     *
     * @param Controller $controllerObject
     * @param string $methodName
     *
     * @return DemoRestricted|null
     */
    private function getAnnotation($controllerObject, $methodName)
    {
        $tokenAnnotation = DemoRestricted::class;

        $classAnnotation = $this->annotationReader->getClassAnnotation(
            new ReflectionClass(ClassUtils::getClass($controllerObject)),
            $tokenAnnotation
        );

        if ($classAnnotation) {
            return null;
        }

        $controllerReflectionObject = new ReflectionObject($controllerObject);
        $reflectionMethod = $controllerReflectionObject->getMethod($methodName);

        return $this->annotationReader->getMethodAnnotation($reflectionMethod, $tokenAnnotation);
    }

    /**
     * Gets query parameters by comparing them to the current request attributes.
     *
     * @param array $queryParametersToKeep
     * @param Request $request
     *
     * @return array
     */
    private function getQueryParamsFromRequestQuery(array $queryParametersToKeep, Request $request)
    {
        $result = [];

        foreach ($queryParametersToKeep as $queryParameterName) {
            $value = $request->get($queryParameterName);
            if (null !== $value) {
                $result[$queryParameterName] = $value;
            }
        }

        return $result;
    }
}
