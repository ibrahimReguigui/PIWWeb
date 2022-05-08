<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationcoursalle
 *
 * @ORM\Table(name="reservationcoursalle", indexes={@ORM\Index(name="idCour", columns={"idCour"}), @ORM\Index(name="idParticipant", columns={"idParticipant"}), @ORM\Index(name="idSalle", columns={"idSalle"})})
 * @ORM\Entity
 */
class Reservationcoursalle
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservation;

    /**
     * @var int
     *
     * @ORM\Column(name="idSalle", type="integer", nullable=false)
     */
    private $idsalle;

    /**
     * @var int
     *
     * @ORM\Column(name="idCour", type="integer", nullable=false)
     */
    private $idcour;

    /**
     * @var int
     *
     * @ORM\Column(name="idParticipant", type="integer", nullable=false)
     */
    private $idparticipant;

    public function getIdreservation(): ?int
    {
        return $this->idreservation;
    }

    public function getIdsalle(): ?int
    {
        return $this->idsalle;
    }

    public function setIdsalle(int $idsalle): self
    {
        $this->idsalle = $idsalle;

        return $this;
    }

    public function getIdcour(): ?int
    {
        return $this->idcour;
    }

    public function setIdcour(int $idcour): self
    {
        $this->idcour = $idcour;

        return $this;
    }

    public function getIdparticipant(): ?int
    {
        return $this->idparticipant;
    }

    public function setIdparticipant(int $idparticipant): self
    {
        $this->idparticipant = $idparticipant;

        return $this;
    }


}
