<?php

namespace App\Entity;

use App\Repository\HallRepository;
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

    #[ORM\OneToOne(mappedBy: 'hallId', cascade: ['persist', 'remove'])]
    private ?HallEquipment $hallEquipment = null;

    #[ORM\OneToOne(mappedBy: 'hallId', cascade: ['persist', 'remove'])]
    private ?HallErgonomy $hallErgonomy = null;

    #[ORM\OneToOne(mappedBy: 'hallId', cascade: ['persist', 'remove'])]
    private ?HallImage $hallImage = null;

    #[ORM\Column(length: 255)]
    private ?string $mainImg = null;

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

    public function getHallEquipment(): ?HallEquipment
    {
        return $this->hallEquipment;
    }

    public function setHallEquipment(HallEquipment $hallEquipment): static
    {
        // set the owning side of the relation if necessary
        if ($hallEquipment->getHallId() !== $this) {
            $hallEquipment->setHallId($this);
        }

        $this->hallEquipment = $hallEquipment;

        return $this;
    }

    public function getHallErgonomy(): ?HallErgonomy
    {
        return $this->hallErgonomy;
    }

    public function setHallErgonomy(HallErgonomy $hallErgonomy): static
    {
        // set the owning side of the relation if necessary
        if ($hallErgonomy->getHallId() !== $this) {
            $hallErgonomy->setHallId($this);
        }

        $this->hallErgonomy = $hallErgonomy;

        return $this;
    }

    public function getHallImage(): ?HallImage
    {
        return $this->hallImage;
    }

    public function setHallImage(HallImage $hallImage): static
    {
        // set the owning side of the relation if necessary
        if ($hallImage->getHallId() !== $this) {
            $hallImage->setHallId($this);
        }

        $this->hallImage = $hallImage;

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
}
