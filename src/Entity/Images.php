<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesRepository::class)]
class Images
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[ORM\OneToOne(mappedBy: 'imgId', cascade: ['persist', 'remove'])]
    private ?HallImage $hallImage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }

    public function getHallImage(): ?HallImage
    {
        return $this->hallImage;
    }

    public function setHallImage(HallImage $hallImage): static
    {
        // set the owning side of the relation if necessary
        if ($hallImage->getImgId() !== $this) {
            $hallImage->setImgId($this);
        }

        $this->hallImage = $hallImage;

        return $this;
    }
}
