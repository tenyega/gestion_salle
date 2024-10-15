<?php

namespace App\Entity;

use App\Repository\HallErgonomyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HallErgonomyRepository::class)]
class HallErgonomy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'hallErgonomy', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hall $hallId = null;

    #[ORM\OneToOne(inversedBy: 'hallErgonomy', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ergonomy $ergonomyId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHallId(): ?Hall
    {
        return $this->hallId;
    }

    public function setHallId(Hall $hallId): static
    {
        $this->hallId = $hallId;

        return $this;
    }

    public function getErgonomyId(): ?Ergonomy
    {
        return $this->ergonomyId;
    }

    public function setErgonomyId(Ergonomy $ergonomyId): static
    {
        $this->ergonomyId = $ergonomyId;

        return $this;
    }
}
