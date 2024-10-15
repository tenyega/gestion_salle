<?php

namespace App\Entity;

use App\Repository\HallEquipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HallEquipmentRepository::class)]
class HallEquipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'hallEquipment')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hall $hallId = null;

    #[ORM\ManyToOne(inversedBy: 'hallEquipment')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipment $equipmentId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHallId(): ?Hall
    {
        return $this->hallId;
    }

    public function setHallId(?Hall $hallId): static
    {
        $this->hallId = $hallId;

        return $this;
    }

    public function getEquipmentId(): ?Equipment
    {
        return $this->equipmentId;
    }

    public function setEquipmentId(?Equipment $equipmentId): static
    {
        $this->equipmentId = $equipmentId;

        return $this;
    }
}
