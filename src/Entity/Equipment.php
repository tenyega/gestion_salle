<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, HallEquipment>
     */
    #[ORM\OneToMany(targetEntity: HallEquipment::class, mappedBy: 'equipmentId', orphanRemoval: true)]
    private Collection $hallEquipment;

    public function __construct()
    {
        $this->hallEquipment = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, HallEquipment>
     */
    public function getHallEquipment(): Collection
    {
        return $this->hallEquipment;
    }

    public function addHallEquipment(HallEquipment $hallEquipment): static
    {
        if (!$this->hallEquipment->contains($hallEquipment)) {
            $this->hallEquipment->add($hallEquipment);
            $hallEquipment->setEquipmentId($this);
        }

        return $this;
    }

    public function removeHallEquipment(HallEquipment $hallEquipment): static
    {
        if ($this->hallEquipment->removeElement($hallEquipment)) {
            // set the owning side to null (unless already changed)
            if ($hallEquipment->getEquipmentId() === $this) {
                $hallEquipment->setEquipmentId(null);
            }
        }

        return $this;
    }

    
}
