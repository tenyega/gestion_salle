<?php

namespace App\Repository;

use App\Entity\Reservation;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }
    /**
     * @return Reservation[] Returns an array of Reservation objects
     */
    public function getUrgentPreReservations()
    {

        $nextDate = new DateTime('+5 day');
        $nowDate = new DateTime();
        $now = $nowDate->format('Y-m-d');
        $next = $nextDate->format('Y-m-d');
        return $this->createQueryBuilder('r')
            ->where('r.isConfirmed = :isConfirmed')
            ->setParameter('isConfirmed', false)
            ->andWhere('r.startDate >= :now')
            ->setParameter('now', $now)
            ->andWhere('r.startDate <= :next')
            ->setParameter('next', $next)
            ->orderBy('r.startDate', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
