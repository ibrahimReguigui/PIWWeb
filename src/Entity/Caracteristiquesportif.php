<?php

namespace App\Entity;

use App\Repository\CaracteristiquesportifRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CaracteristiquesportifRepository::class)
 */
class Caracteristiquesportif
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tailleSportif;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $poidSportif;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ageSportif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $objectifNutrition;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $bmiSportif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $besoinProteine;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $besoinCarb;

    /**
     * @ORM\Column(type="float")
     */
    private $besoinCalories;

    /**
     * @ORM\OneToOne(targetEntity=Utilisateur::class, inversedBy="caracteristiquesportif", cascade={"persist", "remove"})
     */
    private $idSportif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTailleSportif(): ?int
    {
        return $this->tailleSportif;
    }

    public function setTailleSportif(?int $tailleSportif): self
    {
        $this->tailleSportif = $tailleSportif;

        return $this;
    }

    public function getPoidSportif(): ?int
    {
        return $this->poidSportif;
    }

    public function setPoidSportif(?int $poidSportif): self
    {
        $this->poidSportif = $poidSportif;

        return $this;
    }

    public function getAgeSportif(): ?int
    {
        return $this->ageSportif;
    }

    public function setAgeSportif(?int $ageSportif): self
    {
        $this->ageSportif = $ageSportif;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getObjectifNutrition(): ?string
    {
        return $this->objectifNutrition;
    }

    public function setObjectifNutrition(?string $objectifNutrition): self
    {
        $this->objectifNutrition = $objectifNutrition;

        return $this;
    }

    public function getBmiSportif(): ?float
    {
        return $this->bmiSportif;
    }

    public function setBmiSportif(?float $bmiSportif): self
    {
        $this->bmiSportif = $bmiSportif;

        return $this;
    }

    public function getBesoinProteine(): ?float
    {
        return $this->besoinProteine;
    }

    public function setBesoinProteine(?float $besoinProteine): self
    {
        $this->besoinProteine = $besoinProteine;

        return $this;
    }

    public function getBesoinCarb(): ?float
    {
        return $this->besoinCarb;
    }

    public function setBesoinCarb(?float $besoinCarb): self
    {
        $this->besoinCarb = $besoinCarb;

        return $this;
    }

    public function getBesoinCalories(): ?float
    {
        return $this->besoinCalories;
    }

    public function setBesoinCalories(float $besoinCalories): self
    {
        $this->besoinCalories = $besoinCalories;

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
}
