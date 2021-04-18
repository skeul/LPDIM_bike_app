<?php

namespace App\Entity;

use App\Repository\ParcoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParcoursRepository::class)
 */
class Parcours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $distance;

    /**
     * @ORM\Column(type="integer")
     */
    private $difficulte;

    /**
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="parcours", orphanRemoval=true)
     */
    private $sorties;

    /**
     * @ORM\ManyToMany(targetEntity=Sommet::class, inversedBy="parcours")
     */
    private $sommet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->sorties = new ArrayCollection();
        $this->sommet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getDifficulte(): ?int
    {
        return $this->difficulte;
    }

    public function setDifficulte(int $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getSorties(): Collection
    {
        return $this->sorties;
    }

    public function addSorty(Sortie $sorty): self
    {
        if (!$this->sorties->contains($sorty)) {
            $this->sorties[] = $sorty;
            $sorty->setParcours($this);
        }

        return $this;
    }

    public function removeSorty(Sortie $sorty): self
    {
        if ($this->sorties->removeElement($sorty)) {
            // set the owning side to null (unless already changed)
            if ($sorty->getParcours() === $this) {
                $sorty->setParcours(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sommet[]
     */
    public function getSommet(): Collection
    {
        return $this->sommet;
    }

    public function addSommet(Sommet $sommet): self
    {
        if (!$this->sommet->contains($sommet)) {
            $this->sommet[] = $sommet;
        }

        return $this;
    }

    public function removeSommet(Sommet $sommet): self
    {
        $this->sommet->removeElement($sommet);

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name . " (" . $this->distance . ")";
    }
}