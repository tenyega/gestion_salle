<?php

namespace App\EventSubscriber;

use Twig\Environment;
use App\Service\ErgonomyService;
use App\Service\CityService;
use App\Service\EquipmentService;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private Environment $twig;
    private CityService $cityService;
    private ErgonomyService $ergonomyService;
    private EquipmentService $equipmentService;

    public function __construct(Environment $twig, CityService $cityService, ErgonomyService $ergonomyService, EquipmentService $equipmentService)
    {
        $this->twig = $twig;
        $this->cityService = $cityService;
        $this->ergonomyService = $ergonomyService;
        $this->equipmentService = $equipmentService;
    }

    public function onKernelController(ControllerEvent $event)
    {
        // Récupérer toutes les villes via le service
        $cities = $this->cityService->getAllCities();
        
        // Récupérer toutes les ergonomies via le service
        $ergonomies = $this->ergonomyService->getAllErgonomies();
        
        // Récupérer toutes les équipements via le service
        $equipments = $this->equipmentService->getAllEquipments();
        
        // Ajouter la variable `cities` à l'environnement Twig
        $this->twig->addGlobal('cities', $cities);
        $this->twig->addGlobal( 'ergonomies', $ergonomies);
        $this->twig->addGlobal('equipments', $equipments);
    }

    public static function getSubscribedEvents()
    {
        return [
            ControllerEvent::class => 'onKernelController',
        ];
    }
}
