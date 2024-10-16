<?php

namespace App\Controller;

use App\Entity\Hall;
use App\Form\HallType;
use App\Repository\HallRepository;
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

    #[Route('/{id}', name: 'app_hall_show', methods: ['GET'])]
    public function show(Hall $hall): Response
    {
        return $this->render('hall/show.html.twig', [
            'hall' => $hall,
        ]);
    }
}
