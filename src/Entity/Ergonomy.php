<?php

namespace App\Entity;

use App\Repository\ErgonomyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, HallErgonomy>
     */
    #[ORM\OneToMany(targetEntity: HallErgonomy::class, mappedBy: 'ergonomyId', orphanRemoval: true)]
    private Collection $hallErgonomies;

    public function __construct()
    {
        $this->hallErgonomies = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, HallErgonomy>
     */
    public function getHallErgonomies(): Collection
    {
        return $this->hallErgonomies;
    }

    public function addHallErgonomy(HallErgonomy $hallErgonomy): static
    {
        if (!$this->hallErgonomies->contains($hallErgonomy)) {
            $this->hallErgonomies->add($hallErgonomy);
            $hallErgonomy->setErgonomyId($this);
        }

        return $this;
    }

    public function removeHallErgonomy(HallErgonomy $hallErgonomy): static
    {
        if ($this->hallErgonomies->removeElement($hallErgonomy)) {
            // set the owning side to null (unless already changed)
            if ($hallErgonomy->getErgonomyId() === $this) {
                $hallErgonomy->setErgonomyId(null);
            }
        }

        return $this;
    }

}
