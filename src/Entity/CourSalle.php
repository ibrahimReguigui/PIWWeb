<?php

namespace App\Entity;

use App\Repository\CourSalleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=CourSalleRepository::class)
 */
class CourSalle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="Nom ne peut pas etre vide")
     */
    private $nomCour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $information;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrActuel;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull(message="Nombre de participant ne peut pas etre vide")
     * @Assert\GreaterThan(0,message="Nombre doit etre superieure a zero")
     */
    private $nbrTotal;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotNull
     * @Assert\GreaterThan("today",message="Date doit etre superieure a celle d'aujourdhui")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     * @Assert\NotNull
     */
    private $tCour;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="courSalles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilisateur;

    /**
     * @ORM\OneToMany(targetEntity=ReservationCourSalle::class, mappedBy="idCour", orphanRemoval=true)
     */
    private $reservationCourSalleCour;



    public function __construct()
    {
        $this->reservationCourSalleCour = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCour(): ?string
    {
        return $this->nomCour;
    }

    public function setNomCour(string $nomCour): self
    {
        $this->nomCour = $nomCour;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(?string $information): self
    {
        $this->information = $information;

        return $this;
    }

    public function getNbrActuel(): ?int
    {
        return $this->nbrActuel;
    }

    public function setNbrActuel(int $nbrActuel): self
    {
        $this->nbrActuel = $nbrActuel;

        return $this;
    }

    public function getNbrTotal(): ?int
    {
        return $this->nbrTotal;
    }

    public function setNbrTotal(int $nbrTotal): self
    {
        $this->nbrTotal = $nbrTotal;

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

    public function getTCour(): ?\DateTimeInterface
    {
        return $this->tCour;
    }

    public function setTCour(\DateTimeInterface $time): self
    {
        $this->tCour = $time;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, ReservationCourSalle>
     */
    public function getReservationCourSalleCour(): Collection
    {
        return $this->reservationCourSalleCour;
    }

    public function addReservationCourSalleCour(ReservationCourSalle $reservationCourSalleCour): self
    {
        if (!$this->reservationCourSalleCour->contains($reservationCourSalleCour)) {
            $this->reservationCourSalleCour[] = $reservationCourSalleCour;
            $reservationCourSalleCour->setIdCour($this);
        }

        return $this;
    }

    public function removeReservationCourSalleCour(ReservationCourSalle $reservationCourSalleCour): self
    {
        if ($this->reservationCourSalleCour->removeElement($reservationCourSalleCour)) {
            // set the owning side to null (unless already changed)
            if ($reservationCourSalleCour->getIdCour() === $this) {
                $reservationCourSalleCour->setIdCour(null);
            }
        }

        return $this;
    }
}
