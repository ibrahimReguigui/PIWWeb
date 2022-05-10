<?php

namespace App\Entity;

use App\Repository\AbonementsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbonementsRepository::class)
 */
class Abonements
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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PrenomSportif;

    /**
     * @ORM\Column(type="date")
     */
    private $dated;

    /**
     * @ORM\Column(type="date")
     */
    private $datef;

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

    public function getPrenomSportif(): ?string
    {
        return $this->PrenomSportif;
    }

    public function setPrenomSportif(string $PrenomSportif): self
    {
        $this->PrenomSportif = $PrenomSportif;

        return $this;
    }

    public function getDated(): ?\DateTimeInterface
    {
        return $this->dated;
    }

    public function setDated(\DateTimeInterface $dated): self
    {
        $this->dated = $dated;

        return $this;
    }

    public function getDatef(): ?\DateTimeInterface
    {
        return $this->datef;
    }

    public function setDatef(\DateTimeInterface $datef): self
    {
        $this->datef = $datef;

        return $this;
    }
}
