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
            if (!in_array($city, $cities)) {
                $cities[] = $city;
            }
        }

        // Retourne la liste unique des villes
        return $cities;
    }
}
