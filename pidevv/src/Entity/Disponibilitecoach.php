<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disponibilitecoach
 *
 * @ORM\Table(name="disponibilitecoach", indexes={@ORM\Index(name="idCoach", columns={"idCoach"})})
 * @ORM\Entity
 */
class Disponibilitecoach
{
    /**
     * @var int
     *
     * @ORM\Column(name="idDisponibilite", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddisponibilite;

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

    public function getIddisponibilite(): ?int
    {
        return $this->iddisponibilite;
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


}
