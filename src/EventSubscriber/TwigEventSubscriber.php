<?php

namespace App\EventSubscriber;

use Twig\Environment;
use App\Service\CityService;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private Environment $twig;
    private CityService $cityService;

    public function __construct(Environment $twig, CityService $cityService)
    {
        $this->twig = $twig;
        $this->cityService = $cityService;
    }

    public function onKernelController(ControllerEvent $event)
    {
        // Récupérer toutes les villes via le service
        $cities = $this->cityService->getAllCities();
        
        // Ajouter la variable `cities` à l'environnement Twig
        $this->twig->addGlobal('cities', $cities);
    }

    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onKernelController',
        ];
    }
}
