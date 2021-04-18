<?php

namespace App\Entity;

use App\Entity\Velo;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ElectricRepository;

/**
 * @ORM\Entity(repositoryClass=ElectricRepository::class)
 */
class Electric extends Velo
{
    /**
     * @ORM\Column(type="integer")
     */
    private $puissance;

    /**
     * @ORM\Column(type="float")
     */
    private $autonomie;

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getAutonomie(): ?float
    {
        return $this->autonomie;
    }

    public function setAutonomie(float $autonomie): self
    {
        $this->autonomie = $autonomie;

        return $this;
    }
}