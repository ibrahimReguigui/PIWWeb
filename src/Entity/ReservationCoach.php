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
     * @ORM\ManyToOne(targetEntity=ReservationCoach::class, inversedBy="reservationCoaches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idReservation;

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

    public function setIdReservation(?self $idReservation): self
    {
        $this->idReservation = $idReservation;

        return $this;
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
}
