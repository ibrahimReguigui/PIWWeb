<?php

namespace App\Entity;

use App\Repository\AbonementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbonementRepository::class)
 */
class Abonement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Salles::class)
     */
    private $idSalle;

    /**
     * @ORM\OneToOne(targetEntity=Sportifs::class, cascade={"persist", "remove"})
     */
    private $idSportif;

    /**
     * @ORM\Column(type="date")
     */
    private $dDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dFin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSalle(): ?Salles
    {
        return $this->idSalle;
    }

    public function setIdSalle(?Salles $idSalle): self
    {
        $this->idSalle = $idSalle;

        return $this;
    }

    public function getIdSportif(): ?Sportifs
    {
        return $this->idSportif;
    }

    public function setIdSportif(?Sportifs $idSportif): self
    {
        $this->idSportif = $idSportif;

        return $this;
    }

    public function getDDebut(): ?\DateTimeInterface
    {
        return $this->dDebut;
    }

    public function setDDebut(\DateTimeInterface $dDebut): self
    {
        $this->dDebut = $dDebut;

        return $this;
    }

    public function getDFin(): ?\DateTimeInterface
    {
        return $this->dFin;
    }

    public function setDFin(\DateTimeInterface $dFin): self
    {
        $this->dFin = $dFin;

        return $this;
    }
}
