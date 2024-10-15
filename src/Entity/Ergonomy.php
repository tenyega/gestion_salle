<?php

namespace App\Entity;

use App\Repository\ErgonomyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ErgonomyRepository::class)]
class Ergonomy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToOne(mappedBy: 'ergonomyId', cascade: ['persist', 'remove'])]
    private ?HallErgonomy $hallErgonomy = null;

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

    public function getHallErgonomy(): ?HallErgonomy
    {
        return $this->hallErgonomy;
    }

    public function setHallErgonomy(HallErgonomy $hallErgonomy): static
    {
        // set the owning side of the relation if necessary
        if ($hallErgonomy->getErgonomyId() !== $this) {
            $hallErgonomy->setErgonomyId($this);
        }

        $this->hallErgonomy = $hallErgonomy;

        return $this;
    }
}
