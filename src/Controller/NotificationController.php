<?php

namespace App\Controller;

use App\Repository\NotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('IS_AUTHENTICATED_FULLY')]
class NotificationController extends AbstractController
{
    #[Route('/notification', name: 'app_notification')]
    public function index(NotificationRepository $notificationRepository): Response
    {

        $notifcations = $notificationRepository->findBy(['userId' => $this->getUser()]);
        return $this->render('notification/index.html.twig', [
            'notifcations' => $notifcations
        ]);
    }
}
