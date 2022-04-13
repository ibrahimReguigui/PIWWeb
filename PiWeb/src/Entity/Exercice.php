<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExerciceRepository::class)
 */
class Exercice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $idExercice;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomExercice;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrRepetition;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrSerie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionExercice;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $categorieExercice;

    
    public function getIdExercice(): ?int
    {
        return $this->idExercice;
    }
 

    public function getNomExercice(): ?string
    {
        return $this->nomExercice;
    }

    public function setNomExercice(string $nomExercice): self
    {
        $this->nomExercice = $nomExercice;

        return $this;
    }

    public function getNbrRepetition(): ?int
    {
        return $this->nbrRepetition;
    }

    public function setNbrRepetition(int $nbrRepetition): self
    {
        $this->nbrRepetition = $nbrRepetition;

        return $this;
    }

    public function getNbrSerie(): ?int
    {
        return $this->nbrSerie;
    }

    public function setNbrSerie(int $nbrSerie): self
    {
        $this->nbrSerie = $nbrSerie;

        return $this;
    }

    public function getDescriptionExercice(): ?string
    {
        return $this->descriptionExercice;
    }

    public function setDescriptionExercice(string $descriptionExercice): self
    {
        $this->descriptionExercice = $descriptionExercice;

        return $this;
    }

    public function getCategorieExercice(): ?string
    {
        return $this->categorieExercice;
    }

    public function setCategorieExercice(string $categorieExercice): self
    {
        $this->categorieExercice = $categorieExercice;

        return $this;
    }
}
