<?php

namespace App\Controller\Admin;

use App\Entity\Hall;
use App\Entity\User;
use App\Entity\Ergonomy;
use App\Entity\Equipment;
use App\Entity\Notification;
use App\Entity\Reservation;
use App\Repository\ReservationRepository;

use App\Service\EmailNotificationService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
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


        $notification = new Notification();
        $notification->setMessage('The Reservation for hall ' . $resaToConfirm->getHallId()->getName() . ' is confirmed by Administrator of the website on ' . (new DateTime())->format('Y-m-d H:i:s') . '.');
        $notification->setUserId($this->getUser());
        $this->em->persist($notification);
        $this->em->flush();

        $resaToConfirm->setConfirmed(true);
        $this->em->persist($resaToConfirm);
        $this->em->flush();


        $this->addFlash('success', 'Reservation pour ' . $resaToConfirm->getHallId()->getName() . ' is Confirmed and waiting for the payment from the client');
        // Redirect back to the referring page
        $referer = $request->headers->get('referer');
        return $this->redirect($referer ?? 'fallback_route');
    }

    //Cancellation of Pre Reservation
    /// NEED TO CHANGE HERE TO CANCEL THE RESERVATION AND TO DELETE FROM THE RESERVATION TABLE 
    #[Route('/admin/cancel/{id}', name: 'app_admin_cancel')]
    public function cancel(int $id, Request $request, EmailNotificationService $emailNotificationService)
    {
        $reservation = $this->reservationRepository->find(['id' => $id]);
        $emailNotificationService->sendEmail($reservation->getUserId()->getEmail(),   [
            'subject' => 'We are extremely sorry ',
            'template' => 'admin/cancel',
        ]);
        $notification = new Notification();
        $notification->setMessage('The Reservation for hall ' . $reservation->getHallId()->getName() . ' is refused by the Administrator of the website on ' . (new DateTime())->format('Y-m-d H:i:s') . '.');
        $notification->setUserId($this->getUser());
        $this->em->persist($notification);
        $this->em->flush();

        $this->em->remove($reservation, true);
        $this->em->flush();


        $this->addFlash('success', 'Reservation on  ' . $reservation->getStartDate()->format('Y-m-d') . ' is deleted and informed the client via mail');
        // Redirect back to the referring page
        $referer = $request->headers->get('referer');
        return $this->redirect($referer ?? 'fallback_route');
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
