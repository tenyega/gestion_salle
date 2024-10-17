<?php

namespace App\Controller;

use App\Form\SearchFormType;
use App\Repository\HallRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HallRepository $hr, Request $request): Response
    {

  // Crée le formulaire
  $form = $this->createForm(SearchFormType::class);
  $form->handleRequest($request);

  $halls = [];

  if ($form->isSubmitted() && $form->isValid()) {
      $data = $form->getData();

      // Récupère les filtres
      $filter = $data['filter'] ?? null;
      $capacity = $data['capacity'] ?? null;

      // Récupère les salles filtrées
   //   dd($halls = $hr->findHallsBySearch($filter, $capacity));
      // Redirection vers la page des salles avec les paramètres
      return $this->redirectToRoute('app_hall_index', [
        'filter' => $filter,
        'capacity' => $capacity,
    ]);
  }
        
       $halls = $hr->findAll();
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
     //       'halls' => $halls,
        ]);
    }
}
