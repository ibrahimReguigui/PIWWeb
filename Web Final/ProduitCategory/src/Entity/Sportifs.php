<?php

namespace App\Entity;

use App\Repository\SportifsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SportifsRepository::class)
 */
class Sportifs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomSportif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSportif(): ?string
    {
        return $this->NomSportif;
    }

    public function setNomSportif(string $NomSportif): self
    {
        $this->NomSportif = $NomSportif;

        return $this;
    }
}
