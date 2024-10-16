<?php

namespace App\Controller;

use App\Entity\Hall;
use App\Entity\HallImage;
use App\Form\HallType;
use App\Repository\HallImageRepository;
use App\Repository\HallRepository;
use App\Repository\ImagesRepository;
use App\Repository\ReservationRepository;
use App\Service\HourCalculator;
use App\Service\PaymentService;
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
    public function show(Hall $hall, HallImageRepository $hallImageRepository, ImagesRepository $imagesRepository): Response
    {
        $id = $hall->getId();
        $images = $hallImageRepository->findBy([
            'hallId' => $id,
        ]);

        return $this->render('hall/show.html.twig', [
            'hall' => $hall,
            'images' => $images
        ]);
    }

    // A Dummy Route to check the HourCalculator
    #[Route('/t/c', name: 'app_time_calulate', methods: ['GET'])]
    public function time(HourCalculator $hourCalculator, ReservationRepository $rr, PaymentService $ps): Response
    {
        $reservaton = $rr->find('3');
        $totalTime = $hourCalculator->calculateTotalHours($reservaton->getStartDate()->format('Y-m-d'), $reservaton->getEndDate()->format('Y-m-d'), $reservaton->getStartTime()->format('H:i:s'), $reservaton->getEndTime()->format('H:i:s'));

        $ps->askCheckout();
        $payment = $ps->addPayment();

        return $this->render('hall/time.html.twig', [
            'totalTime' => $totalTime,
            'payment' => $payment

        ]);
    }
}
