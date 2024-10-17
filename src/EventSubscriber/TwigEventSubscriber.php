<?php

namespace App\EventSubscriber;

use Twig\Environment;
use App\Service\CityService;
use App\Service\ErgonomyService;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private Environment $twig;
    private CityService $cityService;
    private ErgonomyService $ergonomyService;

    public function __construct(Environment $twig, CityService $cityService, ErgonomyService $ergonomyService)
    {
        $this->twig = $twig;
        $this->cityService = $cityService;
        $this->ergonomyService = $ergonomyService;
    }

    public function onKernelController(ControllerEvent $event)
    {
        // Récupérer toutes les villes via le service
        $cities = $this->cityService->getAllCities();
        
        // Récupérer toutes les ergonomies via le service
        $ergonomies = $this->ergonomyService->getAllErgonomies();
        
        // Ajouter la variable `cities` à l'environnement Twig
        $this->twig->addGlobal('cities', $cities);
        $this->twig->addGlobal( 'ergonomies', $ergonomies);
    }

    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onKernelController',
        ];
    }
}
