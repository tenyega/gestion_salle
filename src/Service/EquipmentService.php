<?php

namespace App\Service;

use App\Repository\EquipmentRepository;

class EquipmentService
{
    private $equipmentRepository;

    public function __construct(EquipmentRepository $equipmentRepository)
    {
        $this->equipmentRepository = $equipmentRepository;
    }

    public function getAllEquipments()
    {
        return $this->equipmentRepository->findAll();
    }
}
