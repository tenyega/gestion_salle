<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 180)]
    private ?string $type = null;

    #[ORM\OneToOne(mappedBy: 'equipmentId', cascade: ['persist', 'remove'])]
    private ?HallEquipment $hallEquipment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getHallEquipment(): ?HallEquipment
    {
        return $this->hallEquipment;
    }

    public function setHallEquipment(HallEquipment $hallEquipment): static
    {
        // set the owning side of the relation if necessary
        if ($hallEquipment->getEquipmentId() !== $this) {
            $hallEquipment->setEquipmentId($this);
        }

        $this->hallEquipment = $hallEquipment;

        return $this;
    }
}
