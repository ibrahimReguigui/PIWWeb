<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exercice
 *
 * @ORM\Table(name="exercice")
 * @ORM\Entity
 */
class Exercice
{
    /**
     * @var int
     *
     * @ORM\Column(name="idExercice", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idexercice;

    /**
     * @var string
     *
     * @ORM\Column(name="nomExercice", type="string", length=20, nullable=false)
     */
    private $nomexercice;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrRepetition", type="integer", nullable=false)
     */
    private $nbrrepetition;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrSerie", type="integer", nullable=false)
     */
    private $nbrserie;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionExercice", type="string", length=255, nullable=false)
     */
    private $descriptionexercice;

    /**
     * @var string
     *
     * @ORM\Column(name="categorieExercice", type="string", length=50, nullable=false)
     */
    private $categorieexercice;

    public function getIdexercice(): ?int
    {
        return $this->idexercice;
    }

    public function getNomexercice(): ?string
    {
        return $this->nomexercice;
    }

    public function setNomexercice(string $nomexercice): self
    {
        $this->nomexercice = $nomexercice;

        return $this;
    }

    public function getNbrrepetition(): ?int
    {
        return $this->nbrrepetition;
    }

    public function setNbrrepetition(int $nbrrepetition): self
    {
        $this->nbrrepetition = $nbrrepetition;

        return $this;
    }

    public function getNbrserie(): ?int
    {
        return $this->nbrserie;
    }

    public function setNbrserie(int $nbrserie): self
    {
        $this->nbrserie = $nbrserie;

        return $this;
    }

    public function getDescriptionexercice(): ?string
    {
        return $this->descriptionexercice;
    }

    public function setDescriptionexercice(string $descriptionexercice): self
    {
        $this->descriptionexercice = $descriptionexercice;

        return $this;
    }

    public function getCategorieexercice(): ?string
    {
        return $this->categorieexercice;
    }

    public function setCategorieexercice(string $categorieexercice): self
    {
        $this->categorieexercice = $categorieexercice;

        return $this;
    }


}
