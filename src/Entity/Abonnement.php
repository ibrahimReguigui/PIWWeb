<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbonnementRepository::class)
 */
class Abonnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="abonnementsSalle")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSalle;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="abonnementsSportif")
     * @ORM\JoinColumn(nullable=false)
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

    public function getIdSalle(): ?Utilisateur
    {
        return $this->idSalle;
    }

    public function setIdSalle(?Utilisateur $idSalle): self
    {
        $this->idSalle = $idSalle;

        return $this;
    }

    public function getIdSportif(): ?Utilisateur
    {
        return $this->idSportif;
    }

    public function setIdSportif(?Utilisateur $idSportif): self
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
