<?php

namespace App\Service;

use App\Repository\HallRepository;

class CityService
{
    private HallRepository $hallRepository;

    public function __construct(HallRepository $hallRepository)
    {
        $this->hallRepository = $hallRepository;
    }

    public function getAllCities(): array
    {
        $halls = $this->hallRepository->findAll();
        $cities = [];

        foreach ($halls as $hall) {
            $city = $hall->getAddresseId()->getCity();
            // Verifie si l'item est déjà dans le tableau pour éviter les doublons
            if (!in_array($city, $cities)) {
                $cities[] = $city;
            }
        }
        sort($cities);
        // Retourne la liste unique des villes triée par ordre alphabétique
        return $cities;
    }
}
