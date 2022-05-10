<?php

namespace App\Entity;

use App\Repository\ReservationCourSalleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationCourSalleRepository::class)
 */
class ReservationCourSalle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=USER::class, inversedBy="reservationCourSalle_Salle")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSalle;

    /**
     * @ORM\ManyToOne(targetEntity=uSER::class, inversedBy="reservationCourSalleSportif")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSportif;

    /**
     * @ORM\ManyToOne(targetEntity=CourSalle::class, inversedBy="reservationCourSalleCour")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCour;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSalle(): ?User
    {
        return $this->idSalle;
    }

    public function setIdSalle(?User $idSalle): self
    {
        $this->idSalle = $idSalle;

        return $this;
    }

    public function getIdSportif(): ?User
    {
        return $this->idSportif;
    }

    public function setIdSportif(?User $idSportif): self
    {
        $this->idSportif = $idSportif;

        return $this;
    }

    public function getIdCour(): ?CourSalle
    {
        return $this->idCour;
    }

    public function setIdCour(?CourSalle $idCour): self
    {
        $this->idCour = $idCour;

        return $this;
    }
}
