<?php

namespace App\Entity;

use App\Entity\Velo;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VTTRepository;

/**
 * @ORM\Entity(repositoryClass=VTTRepository::class)
 */
class VTT extends Velo
{

    /**
     * @ORM\Column(type="integer")
     */
    private $suspension_avant;

    /**
     * @ORM\Column(type="integer")
     */
    private $suspension_arriere;

    public function getSuspensionAvant(): ?int
    {
        return $this->suspension_avant;
    }

    public function setSuspensionAvant(int $suspension_avant): self
    {
        $this->suspension_avant = $suspension_avant;

        return $this;
    }

    public function getSuspensionArriere(): ?int
    {
        return $this->suspension_arriere;
    }

    public function setSuspensionArriere(int $suspension_arriere): self
    {
        $this->suspension_arriere = $suspension_arriere;

        return $this;
    }

    public function getClass($object)
    {
        return (new \ReflectionClass($object))->getShortName();
    }
}