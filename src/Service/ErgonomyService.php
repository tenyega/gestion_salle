<?php

namespace App\Service;

use App\Repository\ErgonomyRepository;

class ErgonomyService
{
    private ErgonomyRepository $ergonomyRepository;

    public function __construct(ErgonomyRepository $ergonomyRepository)
    {
        $this->ergonomyRepository = $ergonomyRepository;
    }

    /**
     * Récupération de toutes les ergonomies
     */
    public function getAllErgonomies(): array
    {
        return $this->ergonomyRepository->findAll();
    }

    /**
     * Récupération de toutes les salles par ergonomie
     */
    public function getHallsByErgonomy(string $ergonomyName): array
    {
        return $this->ergonomyRepository
            ->createQueryBuilder('e')
            ->join('e.hallErgonomies', 'he')
            ->join('he.hallId', 'h')
            ->andWhere('e.name = :name')
            ->setParameter('name', $ergonomyName)
            ->getQuery()
            ->getResult();
    }
}
