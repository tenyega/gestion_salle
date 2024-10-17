<?php

namespace App\Controller;

use App\Entity\Hall;
use App\Form\HallType;
use App\Entity\HallImage;
use App\Form\SearchFormType;
use App\Repository\HallRepository;
use App\Repository\ImagesRepository;

use App\Repository\HallImageRepository;

use App\Repository\ReservationRepository;
use App\Service\HourCalculator;
use App\Service\PaymentService;
use DateInterval;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/hall')]
#[IsGranted('IS_AUTHENTICATED_FULLY')]
class HallController extends AbstractController
{
    #[Route('', name: 'app_hall_index', methods: ['GET'])]
    public function index(HallRepository $hr, Request $request): Response
    {
        if ($request) {
            // Récupérer les paramètres de la requête
            $filter = $request->query->get('filter', '');

            // Convertir la capacité en entier si elle existe, sinon laisser à null
            $capacity = $request->query->get('capacity', null);
            if ($capacity !== null) {
                $capacity = (int)$capacity; // Conversion en entier
            }

            // Rechercher les salles avec les filtres
            $halls = $hr->findHallsBySearch($filter, $capacity);
            return $this->render('hall/index.html.twig', [
                'halls' => $halls,
            ]);
        }


        $halls = $hr->findAll();
        return $this->render('hall/index.html.twig', [
            'form' => $form->createView(),
            'halls' => $halls,
        ]);
    }

    #[Route('/city/{name}', name: 'app_halls_by_city', methods: ['GET'])]
    public function getByCity($name, Request $request, HallRepository $hr): Response
    {
        $halls = $hr->findByCity($name);
        return $this->render('hall/by_city.html.twig', [
            'cityName' => $name,
            'halls' => $halls,
        ]);
    }

    #[Route('/ergonomy/{name}', name: 'app_halls_by_ergonomy', methods: ['GET'])]
    public function getByErgonomy(string $name, HallRepository $hr): Response
    {
        // Utilisation du service pour récupérer les salles par ergonomie
        $halls = $hr->findByErgonomy($name);

        return $this->render('hall/by_ergonomy.html.twig', [
            'ergonomyName' => $name,
            'halls' => $halls,
        ]);
    }

    #[Route('/halls/filter', name: 'app_halls_by_equipments', methods: ['GET'])]
    public function filterByEquipments(Request $request, HallRepository $hr)
    {
        // Utilisation de `get()` avec `[]` comme valeur par défaut pour récupérer un tableau
        $selectedEquipments = $request->query->all('equipments') ?? [];

        // Si aucun équipement sélectionné, retourner toutes les salles
        if (empty($selectedEquipments)) {
            $halls = $hr->findAll();
        } else {
            // Sinon, filtrer les salles en fonction des équipements sélectionnés
            $halls = $hr->findByEquipments($selectedEquipments);
        }

        return $this->render('hall/index.html.twig', [
            'halls' => $halls,
        ]);
    }

    #[Route('/{id}', name: 'app_hall_show', methods: ['GET'])]

    public function show(Hall $hall, HallImageRepository $hir, ImagesRepository $ir): Response
    {
        $id = $hall->getId();
        $images = $hir->findBy([


            'hallId' => $id,
        ]);

        return $this->render('hall/show.html.twig', [
            'hall' => $hall,
            'images' => $images
        ]);
    }

    #[Route('/calender/{id}', name: 'app_hall_calender', methods: ['GET'])]

    public function fullCalender(int $id, ReservationRepository $reservationRepository)
    {
        $events = [];
        // brings all the reservation with this hallid. 
        $reservations = $reservationRepository->findBy(['hallId' => $id]);
        foreach ($reservations as $r) {
          
                $events[] = array('title' => 'Reserved', 'start' => $r->getStartDate()->format('Y-m-d'), 'end' => $r->getEndDate()->format('Y-m-d'));
            
        }


        // events: [
        //     {
        //         title: 'All Day Event',
        //         start: '2022-04-01'
        //     },
        //     {
        //         title: 'Long Event',
        //         start: '2022-04-07',
        //         end: '2022-04-10'
        //     }]
        return $this->render('hall/fullCalender.html.twig', [
            'events' => json_encode($events)
        ]);
    }
}
