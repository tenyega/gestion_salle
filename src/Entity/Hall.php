<?php

namespace App\Entity;

use App\Repository\HallRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HallRepository::class)]
class Hall
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 120)]
    private ?string $area = null;

    #[ORM\Column(length: 255)]
    private ?string $accessibility = null;

    #[ORM\Column]
    private ?int $capacityMax = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $pricePerHour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $openingTime = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $closingTime = null;

    #[ORM\OneToOne(inversedBy: 'hall', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?EventType $eventTypeId = null;

    #[ORM\OneToOne(inversedBy: 'hall', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $addresseId = null;

    /**
     * @var Collection<int, Equipment>
     */
    #[ORM\ManyToMany(targetEntity: Equipment::class, inversedBy: 'halls')]
    private Collection $listEquipment;

    /**
     * @var Collection<int, Ergonomy>
     */
    #[ORM\ManyToMany(targetEntity: Ergonomy::class, inversedBy: 'halls')]
    private Collection $listErgonomy;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'hallId', orphanRemoval: false)]
    private Collection $reservations;

    public function __construct()
    {
        $this->listEquipment = new ArrayCollection();
        $this->listErgonomy = new ArrayCollection();
        $this->reservations = new ArrayCollection();
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

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): static
    {
        $this->area = $area;

        return $this;
    }

    public function getAccessibility(): ?string
    {
        return $this->accessibility;
    }

    public function setAccessibility(string $accessibility): static
    {
        $this->accessibility = $accessibility;

        return $this;
    }

    public function getCapacityMax(): ?int
    {
        return $this->capacityMax;
    }

    public function setCapacityMax(int $capacityMax): static
    {
        $this->capacityMax = $capacityMax;

        return $this;
    }

    public function getPricePerHour(): ?string
    {
        return $this->pricePerHour;
    }

    public function setPricePerHour(string $pricePerHour): static
    {
        $this->pricePerHour = $pricePerHour;

        return $this;
    }

    public function getOpeningTime(): ?\DateTimeInterface
    {
        return $this->openingTime;
    }

    public function setOpeningTime(\DateTimeInterface $openingTime): static
    {
        $this->openingTime = $openingTime;

        return $this;
    }

    public function getClosingTime(): ?\DateTimeInterface
    {
        return $this->closingTime;
    }

    public function setClosingTime(\DateTimeInterface $closingTime): static
    {
        $this->closingTime = $closingTime;

        return $this;
    }

    public function getEventTypeId(): ?EventType
    {
        return $this->eventTypeId;
    }

    public function setEventTypeId(EventType $eventTypeId): static
    {
        $this->eventTypeId = $eventTypeId;

        return $this;
    }

    public function getAddresseId(): ?Address
    {
        return $this->addresseId;
    }

    public function setAddresseId(Address $addresseId): static
    {
        $this->addresseId = $addresseId;

        return $this;
    }

    /**
     * @return Collection<int, Equipment>
     */
    public function getListEquipment(): Collection
    {
        return $this->listEquipment;
    }

    public function addListEquipment(Equipment $listEquipment): static
    {
        if (!$this->listEquipment->contains($listEquipment)) {
            $this->listEquipment->add($listEquipment);
        }

        return $this;
    }

    public function removeListEquipment(Equipment $listEquipment): static
    {
        $this->listEquipment->removeElement($listEquipment);

        return $this;
    }

    /**
     * @return Collection<int, Ergonomy>
     */
    public function getListErgonomy(): Collection
    {
        return $this->listErgonomy;
    }

    public function addListErgonomy(Ergonomy $listErgonomy): static
    {
        if (!$this->listErgonomy->contains($listErgonomy)) {
            $this->listErgonomy->add($listErgonomy);
        }

        return $this;
    }

    public function removeListErgonomy(Ergonomy $listErgonomy): static
    {
        $this->listErgonomy->removeElement($listErgonomy);

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setHallId($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getHallId() === $this) {
                $reservation->setHallId(null);
            }
        }

        return $this;
    }
}
