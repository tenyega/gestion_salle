<?php

namespace App\Controller;

use App\Repository\HallRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(HallRepository $hr): Response
    {
        $halls = $hr->findAll();
        return $this->render('home/index.html.twig', [
            'halls' => $halls,
        ]);
    }
}
