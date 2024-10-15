<?php

namespace App\Controller\Admin;

use App\Entity\Equipment;
use App\Entity\Ergonomy;
use App\Entity\Hall;
use App\Entity\Reservation;
use App\Entity\User;
use App\Repository\ReservationRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{

    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $unconfirmedReservations = $this->reservationRepository->getUrgentPreReservations();
        return $this->render('admin/dashboard.html.twig', [
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
