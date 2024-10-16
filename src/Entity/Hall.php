<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use App\Repository\HallRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

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

    #[ORM\Column(length: 255)]
    private ?string $mainImg = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'hallId')]
    private Collection $reservations;

    /**
     * @var Collection<int, HallEquipment>
     */
    #[ORM\OneToMany(targetEntity: HallEquipment::class, mappedBy: 'hallId', orphanRemoval: true)]
    private Collection $hallEquipment;

    /**
     * @var Collection<int, HallErgonomy>
     */

    #[ORM\OneToMany(targetEntity: HallErgonomy::class, mappedBy: 'hallId', orphanRemoval: true)]
    private Collection $hallErgonomies;

    /**
     * @var Collection<int, HallImage>
     */
    #[ORM\OneToMany(targetEntity: HallImage::class, mappedBy: 'hallId', orphanRemoval: true)]
    private Collection $hallImages;


    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->hallEquipment = new ArrayCollection();
        $this->hallErgonomies = new ArrayCollection();
        $this->hallImages = new ArrayCollection();
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

    public function getMainImg(): ?string
    {
        return $this->mainImg;
    }

    public function setMainImg(string $mainImg): static
    {
        $this->mainImg = $mainImg;

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
            $hallEquipment->setHallId($this);
        }

        return $this;
    }

    public function removeHallEquipment(HallEquipment $hallEquipment): static
    {
        if ($this->hallEquipment->removeElement($hallEquipment)) {
            // set the owning side to null (unless already changed)
            if ($hallEquipment->getHallId() === $this) {
                $hallEquipment->setHallId(null);
            }
        }

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
            $hallErgonomy->setHallId($this);
        }

        return $this;
    }

    public function removeHallErgonomy(HallErgonomy $hallErgonomy): static
    {
        if ($this->hallErgonomies->removeElement($hallErgonomy)) {
            // set the owning side to null (unless already changed)
            if ($hallErgonomy->getHallId() === $this) {
                $hallErgonomy->setHallId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, HallImage>
     */
    public function getHallImages(): Collection
    {
        return $this->hallImages;
    }

    public function addHallImage(HallImage $hallImage): static
    {
        if (!$this->hallImages->contains($hallImage)) {
            $this->hallImages->add($hallImage);
            $hallImage->setHallId($this);
        }

        return $this;
    }

    public function removeHallImage(HallImage $hallImage): static
    {
        if ($this->hallImages->removeElement($hallImage)) {
            // set the owning side to null (unless already changed)
            if ($hallImage->getHallId() === $this) {
                $hallImage->setHallId(null);
            }
        }

        return $this;
    }
}
