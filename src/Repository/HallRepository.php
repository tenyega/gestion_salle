<?php

namespace App\Repository;

use App\Entity\Hall;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Hall>
 */
class HallRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hall::class);
    }

    /**
     * Récupération de toutes les salles dans une ville spécifique
     */
    public function findByCity(string $city): array
    {
        return $this->createQueryBuilder('h')
            ->join('h.addresseId', 'a') // 'a' représente l'entité Address
            ->andWhere('a.city = :city')
            ->setParameter('city', $city)
            ->getQuery()
            ->getResult();
    }


}
