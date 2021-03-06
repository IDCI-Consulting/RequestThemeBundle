<?php

/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @author:  Brahim Boukoufallah <brahim.boukoufallah@idci-consulting.fr>
 * @license: MIT
 */

namespace IDCI\Bundle\RequestThemeBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
use IDCI\Bundle\RequestThemeBundle\Theme\ThemeManager;

class ThemeEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var ThemeManager
     */
    private $themeManager;

    /**
     * @var FilesystemLoader
     */
    private $twigLoader;

    /**
     * Constructor
     *
     * @param ThemeManager     $themeManager
     * @param FilesystemLoader $twigLoader
     */
    public function __construct(
        ThemeManager     $themeManager,
        FilesystemLoader $twigLoader
    )
    {
        $this->themeManager = $themeManager;
        $this->twigLoader   = $twigLoader;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(
                array('guessTheme', 0)
            ),
            KernelEvents::RESPONSE => array(
                array('addThemeHeader', 0)
            )
        );
    }

    public function guessTheme(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return false;
        }

        $request = $event->getRequest();
        $theme   = $this->themeManager->guessTheme($request);

        if (null !== $theme) {
            // Add theme path to twig loader
            $this->twigLoader->addPath(
                $theme->getTemplatePath(),
                $theme::TEMPLATE_NAMESPACE
            );
        }
    }

    public function addThemeHeader(FilterResponseEvent $event)
    {
        if (null !== $this->themeManager->getCurrentTheme()) {
            $response = $event->getResponse();
            $response->headers->set('X-Theme-Alias', $this->themeManager->getCurrentTheme()->getAlias());
            $response->headers->set('X-Theme-Name', $this->themeManager->getCurrentTheme()->getName());
        }
    }
}
