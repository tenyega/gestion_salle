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

        /**
     * Récupération de toutes les salles associées à une ergonomie spécifique
     */
    public function findByErgonomy(string $ergonomyName): array
    {
        return $this->createQueryBuilder('h')
            ->join('h.hallErgonomies', 'he')  // Jointure avec HallErgonomy
            ->join('he.ergonomyId', 'e')      // Jointure avec Ergonomy
            ->andWhere('e.name = :name')      // Filtrer par le nom de l'ergonomie
            ->setParameter('name', $ergonomyName)
            ->getQuery()
            ->getResult();
    }

    public function findByEquipments(array $equipmentIds)
    {
        return $this->createQueryBuilder('h')
            ->join('h.hallEquipment', 'he')
            ->where('he.equipmentId IN (:equipmentIds)')
            ->setParameter('equipmentIds', $equipmentIds)
            ->getQuery()
            ->getResult();
    }

    /**
     * Recherche de salles en fonction des filtres (ville, ergonomie, équipement, type d'événement, capacité).
     */
    public function findHallsBySearch(?string $filter, ?int $capacity): array
    {
        $qb = $this->createQueryBuilder('h')
            ->leftJoin('h.addresseId', 'a') // Jointure avec Address pour accéder à la ville
            ->leftJoin('h.hallErgonomies', 'he') // Jointure avec HallErgonomy pour l'ergonomie
            ->leftJoin('he.ergonomyId', 'e') // Jointure avec Ergonomy pour le nom de l'ergonomie
            ->leftJoin('h.hallEquipment', 'heq') // Jointure avec HallEquipment pour les équipements
            ->leftJoin('heq.equipmentId', 'eq'); // Jointure avec Equipment
         //   ->leftJoin('h.eventTypeId', 'et'); // Jointure avec EventType pour accéder au type d'événement
    
        if ($filter) {
            // Filtrer par ville, ergonomie, équipement, ou type d'événement
      //      $qb->andWhere('a.city LIKE :filter OR e.name LIKE :filter OR eq.name LIKE :filter OR h.eventTypeId LIKE :filter')
            $qb->andWhere('a.city LIKE :filter OR e.name LIKE :filter OR eq.name LIKE :filter ')
               ->setParameter('filter', '%' . $filter . '%');
        }
    
        if ($capacity !== null) {
            // Filtrer par capacité
            $qb->andWhere('h.capacityMax >= :capacity')
               ->setParameter('capacity', $capacity);
        }
    
        return $qb->getQuery()->getResult();
    }


}
