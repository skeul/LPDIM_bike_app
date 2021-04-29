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
    private $suspensionAvant;

    /**
     * @ORM\Column(type="integer")
     */
    private $suspensionArriere;

    public function getSuspensionAvant(): ?int
    {
        return $this->suspensionAvant;
    }

    public function setSuspensionAvant(int $suspensionAvant): self
    {
        $this->suspensionAvant = $suspensionAvant;

        return $this;
    }

    public function getSuspensionArriere(): ?int
    {
        return $this->suspensionArriere;
    }

    public function setSuspensionArriere(int $suspensionArriere): self
    {
        $this->suspensionArriere = $suspensionArriere;

        return $this;
    }

    public function getClass($object)
    {
        return (new \ReflectionClass($object))->getShortName();
    }
}