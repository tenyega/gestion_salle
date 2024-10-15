<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, HallImage>
     */
    #[ORM\OneToMany(targetEntity: HallImage::class, mappedBy: 'imgId', orphanRemoval: true)]
    private Collection $hallImages;

    public function __construct()
    {
        $this->hallImages = new ArrayCollection();
    }

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
            $hallImage->setImgId($this);
        }

        return $this;
    }

    public function removeHallImage(HallImage $hallImage): static
    {
        if ($this->hallImages->removeElement($hallImage)) {
            // set the owning side to null (unless already changed)
            if ($hallImage->getImgId() === $this) {
                $hallImage->setImgId(null);
            }
        }

        return $this;
    }
}
