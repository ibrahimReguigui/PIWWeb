<?php

namespace App\Entity;

use App\Repository\ReservationCoachRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationCoachRepository::class)
 */
class ReservationCoach
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\OneToMany(targetEntity=ReservationCoach::class, mappedBy="idReservation")
     */
    private $reservationCoaches;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="reservationCoaches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idParticipant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="reservationCoachCoach")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCoach;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    public function __construct()
    {
        $this->reservationCoaches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReservation(): ?self
    {
        return $this->idReservation;
    }



    /**
     * @return Collection<int, self>
     */
    public function getReservationCoaches(): Collection
    {
        return $this->reservationCoaches;
    }

    public function addReservationCoach(self $reservationCoach): self
    {
        if (!$this->reservationCoaches->contains($reservationCoach)) {
            $this->reservationCoaches[] = $reservationCoach;
            $reservationCoach->setIdReservation($this);
        }

        return $this;
    }

    public function removeReservationCoach(self $reservationCoach): self
    {
        if ($this->reservationCoaches->removeElement($reservationCoach)) {
            // set the owning side to null (unless already changed)
            if ($reservationCoach->getIdReservation() === $this) {
                $reservationCoach->setIdReservation(null);
            }
        }

        return $this;
    }

    public function getIdParticipant(): ?Utilisateur
    {
        return $this->idParticipant;
    }

    public function setIdParticipant(?Utilisateur $idParticipant): self
    {
        $this->idParticipant = $idParticipant;

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

    public function getIdCoach(): ?Utilisateur
    {
        return $this->idCoach;
    }

    public function setIdCoach(?Utilisateur $idCoach): self
    {
        $this->idCoach = $idCoach;

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
