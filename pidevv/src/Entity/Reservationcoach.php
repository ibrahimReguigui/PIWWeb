<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservationcoach
 *
 * @ORM\Table(name="reservationcoach", indexes={@ORM\Index(name="idCoach", columns={"idCoach"}), @ORM\Index(name="idParticipant", columns={"idParticipant"})})
 * @ORM\Entity
 */
class Reservationcoach
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReservationCoach", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservationcoach;

    /**
     * @var int
     *
     * @ORM\Column(name="idCoach", type="integer", nullable=false)
     */
    private $idcoach;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time", nullable=false)
     */
    private $time;

    /**
     * @var int
     *
     * @ORM\Column(name="idParticipant", type="integer", nullable=false)
     */
    private $idparticipant;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=20, nullable=false)
     */
    private $etat;

    public function getIdreservationcoach(): ?int
    {
        return $this->idreservationcoach;
    }

    public function getIdcoach(): ?int
    {
        return $this->idcoach;
    }

    public function setIdcoach(int $idcoach): self
    {
        $this->idcoach = $idcoach;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }


}
