<?php

namespace App\Entity;

use App\Repository\HallImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HallImageRepository::class)]
class HallImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'hallImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hall $hallId = null;

    #[ORM\ManyToOne(inversedBy: 'hallImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Images $imgId = null;

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

    public function getImgId(): ?Images
    {
        return $this->imgId;
    }

    public function setImgId(?Images $imgId): static
    {
        $this->imgId = $imgId;

        return $this;
    }

   
}
