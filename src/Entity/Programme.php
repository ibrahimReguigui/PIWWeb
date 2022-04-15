<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgrammeRepository::class)
 */
class Programme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomProgramme;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $objectifProgramme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionProgramme;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $categorieProgramme;

    /**
     * @ORM\ManyToOne(targetEntity=Exercice::class, inversedBy="programmes")
     */
    private $exercices;

  
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProgramme(): ?string
    {
        return $this->nomProgramme;
    }

    public function setNomProgramme(string $nomProgramme): self
    {
        $this->nomProgramme = $nomProgramme;

        return $this;
    }

    public function getObjectifProgramme(): ?string
    {
        return $this->objectifProgramme;
    }

    public function setObjectifProgramme(string $objectifProgramme): self
    {
        $this->objectifProgramme = $objectifProgramme;

        return $this;
    }

    public function getDescriptionProgramme(): ?string
    {
        return $this->descriptionProgramme;
    }

    public function setDescriptionProgramme(string $descriptionProgramme): self
    {
        $this->descriptionProgramme = $descriptionProgramme;

        return $this;
    }

    public function getCategorieProgramme(): ?string
    {
        return $this->categorieProgramme;
    }

    public function setCategorieProgramme(string $categorieProgramme): self
    {
        $this->categorieProgramme = $categorieProgramme;

        return $this;
    }

    public function getExercices(): ?Exercice
    {
        return $this->exercices;
    }

    public function setExercices(?Exercice $exercices): self
    {
        $this->exercices = $exercices;

        return $this;
    }

    public function __toString() {
        return $this->exercices;
    }
}
