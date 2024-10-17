<?php

namespace App\Controller;

use App\Entity\Hall;
use App\Form\HallType;
use App\Repository\HallRepository;
use App\Repository\ImagesRepository;
use App\Repository\HallImageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/hall')]
class HallController extends AbstractController
{
    #[Route('', name: 'app_hall_index', methods: ['GET'])]
    public function index(HallRepository $hr): Response
    {
        $halls = $hr->findAll();
        return $this->render('hall/index.html.twig', [
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
    

}
