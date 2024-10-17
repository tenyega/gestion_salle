<?php

namespace App\Controller\Admin;

use App\Entity\Equipment;
use App\Entity\Ergonomy;
use App\Entity\Hall;
use App\Entity\Reservation;
use App\Entity\User;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{

    private $reservationRepository;
    private $em;
    public function __construct(ReservationRepository $reservationRepository, EntityManagerInterface $entityManagerInterface)
    {
        $this->reservationRepository = $reservationRepository;
        $this->em = $entityManagerInterface;
    }
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        $unconfirmedReservations = $this->reservationRepository->getUrgentPreReservations();
        return $this->render('admin/dashboard.html.twig', [
            'unconfirmedReservations' => $unconfirmedReservations,
        ]);
    }

    //Confirmation Pre Reservation
    #[Route('/admin/confirm/{id}', name: 'app_admin_confirm')]
    public function confirm(int $id, Request $request)
    {
        $resaToConfirm = $this->reservationRepository->find(['id' => $id]);
        $resaToConfirm->setConfirmed(true);
        $this->em->persist($resaToConfirm);
        $this->em->flush();
        $this->addFlash('success', 'Reservation pour ' . $resaToConfirm->getHallId()->getName() . ' is Confirmed and waiting for the payment from the client');
        // Redirect back to the referring page
        $referer = $request->headers->get('referer');
        return $this->redirect($referer ?? 'fallback_route');
    }

    //Cancellation of Pre Reservation
    #[Route('/admin/cancel', name: 'app_admin_cancel')]
    public function cancel(): Response
    {
        $unconfirmedReservations = $this->reservationRepository->getUrgentPreReservations();
        return $this->render('admin/cancel.html.twig', [
            'unconfirmedReservations' => $unconfirmedReservations,
        ]);
    }



    public function configureDashboard(): Dashboard
    {


        return Dashboard::new()
            ->setTitle('Gestion Salle');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Halls', 'fas fa-building', Hall::class);
        yield MenuItem::linkToCrud('Reservations', 'fas fa-calendar-alt', Reservation::class);
        yield MenuItem::linkToCrud('Equipments', 'fas fa-tools', Equipment::class);
        yield MenuItem::linkToCrud('Ergonomy', 'fas fa-chair', Ergonomy::class);
    }
}
