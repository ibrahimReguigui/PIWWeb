<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=CourSalle::class, mappedBy="Utilisateur")
     */
    private $courSalles;

    /**
     * @ORM\OneToMany(targetEntity=ReservationCourSalle::class, mappedBy="idSalle")
     */
    private $reservationCourSalle_Salle;

    /**
     * @ORM\OneToMany(targetEntity=ReservationCourSalle::class, mappedBy="idSportif")
     */
    private $reservationCourSalleSportif;

    /**
     * @ORM\OneToMany(targetEntity=Abonnement::class, mappedBy="idSalle")
     */
    private $abonnementsSalle;

    /**
     * @ORM\OneToMany(targetEntity=Abonnement::class, mappedBy="idSportif")
     */
    private $abonnementsSportif;

    /**
     * @ORM\OneToMany(targetEntity=DisponibiliteCoach::class, mappedBy="idCoach")
     */
    private $disponibiliteCoaches;

    /**
     * @ORM\OneToMany(targetEntity=ReservationCoach::class, mappedBy="idParticipant")
     */
    private $reservationCoaches;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $whoami;


    public function __construct()
    {
        $this->reservationCourSalle_Salle = new ArrayCollection();
        $this->reservationCourSalleSportif = new ArrayCollection();
        $this->abonnementsSalle = new ArrayCollection();
        $this->abonnementsSportif = new ArrayCollection();
        $this->disponibiliteCoaches = new ArrayCollection();
        $this->reservationCoaches = new ArrayCollection();

    }





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, CourSalle>
     */
    public function getCourSalles(): Collection
    {
        return $this->courSalles;
    }

    public function addCourSalle(CourSalle $courSalle): self
    {
        if (!$this->courSalles->contains($courSalle)) {
            $this->courSalles[] = $courSalle;
            $courSalle->setUtilisateur($this);
        }

        return $this;
    }

    public function removeCourSalle(CourSalle $courSalle): self
    {
        if ($this->courSalles->removeElement($courSalle)) {
            // set the owning side to null (unless already changed)
            if ($courSalle->getUtilisateur() === $this) {
                $courSalle->setUtilisateur(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, ReservationCourSalle>
     */
    public function getReservationCourSalleSalle(): Collection
    {
        return $this->reservationCourSalle_Salle;
    }

    public function addReservationCourSalleSalle(ReservationCourSalle $reservationCourSalleSalle): self
    {
        if (!$this->reservationCourSalle_Salle->contains($reservationCourSalleSalle)) {
            $this->reservationCourSalle_Salle[] = $reservationCourSalleSalle;
            $reservationCourSalleSalle->setIdSalle($this);
        }

        return $this;
    }

    public function removeReservationCourSalleSalle(ReservationCourSalle $reservationCourSalleSalle): self
    {
        if ($this->reservationCourSalle_Salle->removeElement($reservationCourSalleSalle)) {
            // set the owning side to null (unless already changed)
            if ($reservationCourSalleSalle->getIdSalle() === $this) {
                $reservationCourSalleSalle->setIdSalle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ReservationCourSalle>
     */
    public function getReservationCourSalleSportif(): Collection
    {
        return $this->reservationCourSalleSportif;
    }

    public function addReservationCourSalleSportif(ReservationCourSalle $reservationCourSalleSportif): self
    {
        if (!$this->reservationCourSalleSportif->contains($reservationCourSalleSportif)) {
            $this->reservationCourSalleSportif[] = $reservationCourSalleSportif;
            $reservationCourSalleSportif->setIdSportif($this);
        }

        return $this;
    }

    public function removeReservationCourSalleSportif(ReservationCourSalle $reservationCourSalleSportif): self
    {
        if ($this->reservationCourSalleSportif->removeElement($reservationCourSalleSportif)) {
            // set the owning side to null (unless already changed)
            if ($reservationCourSalleSportif->getIdSportif() === $this) {
                $reservationCourSalleSportif->setIdSportif(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Abonnement>
     */
    public function getAbonnementsSalle(): Collection
    {
        return $this->abonnementsSalle;
    }

    public function addAbonnementsSalle(Abonnement $abonnementsSalle): self
    {
        if (!$this->abonnementsSalle->contains($abonnementsSalle)) {
            $this->abonnementsSalle[] = $abonnementsSalle;
            $abonnementsSalle->setIdSalle($this);
        }

        return $this;
    }

    public function removeAbonnementsSalle(Abonnement $abonnementsSalle): self
    {
        if ($this->abonnementsSalle->removeElement($abonnementsSalle)) {
            // set the owning side to null (unless already changed)
            if ($abonnementsSalle->getIdSalle() === $this) {
                $abonnementsSalle->setIdSalle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Abonnement>
     */
    public function getAbonnementsSportif(): Collection
    {
        return $this->abonnementsSportif;
    }

    public function addAbonnementsSportif(Abonnement $abonnementsSportif): self
    {
        if (!$this->abonnementsSportif->contains($abonnementsSportif)) {
            $this->abonnementsSportif[] = $abonnementsSportif;
            $abonnementsSportif->setIdSportif($this);
        }

        return $this;
    }

    public function removeAbonnementsSportif(Abonnement $abonnementsSportif): self
    {
        if ($this->abonnementsSportif->removeElement($abonnementsSportif)) {
            // set the owning side to null (unless already changed)
            if ($abonnementsSportif->getIdSportif() === $this) {
                $abonnementsSportif->setIdSportif(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DisponibiliteCoach>
     */
    public function getDisponibiliteCoaches(): Collection
    {
        return $this->disponibiliteCoaches;
    }

    public function addDisponibiliteCoach(DisponibiliteCoach $disponibiliteCoach): self
    {
        if (!$this->disponibiliteCoaches->contains($disponibiliteCoach)) {
            $this->disponibiliteCoaches[] = $disponibiliteCoach;
            $disponibiliteCoach->setIdCoach($this);
        }

        return $this;
    }

    public function removeDisponibiliteCoach(DisponibiliteCoach $disponibiliteCoach): self
    {
        if ($this->disponibiliteCoaches->removeElement($disponibiliteCoach)) {
            // set the owning side to null (unless already changed)
            if ($disponibiliteCoach->getIdCoach() === $this) {
                $disponibiliteCoach->setIdCoach(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ReservationCoach>
     */
    public function getReservationCoaches(): Collection
    {
        return $this->reservationCoaches;
    }

    public function addReservationCoach(ReservationCoach $reservationCoach): self
    {
        if (!$this->reservationCoaches->contains($reservationCoach)) {
            $this->reservationCoaches[] = $reservationCoach;
            $reservationCoach->setIdParticipant($this);
        }

        return $this;
    }

    public function removeReservationCoach(ReservationCoach $reservationCoach): self
    {
        if ($this->reservationCoaches->removeElement($reservationCoach)) {
            // set the owning side to null (unless already changed)
            if ($reservationCoach->getIdParticipant() === $this) {
                $reservationCoach->setIdParticipant(null);
            }
        }

        return $this;
    }

    public function getWhoami(): ?string
    {
        return $this->whoami;
    }

    public function setWhoami(string $whoami): self
    {
        $this->whoami = $whoami;

        return $this;
    }





}
