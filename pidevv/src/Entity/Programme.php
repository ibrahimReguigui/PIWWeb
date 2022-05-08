<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Programme
 *
 * @ORM\Table(name="programme", indexes={@ORM\Index(name="idExercice", columns={"idExercice"})})
 * @ORM\Entity
 */
class Programme
{
    /**
     * @var int
     *
     * @ORM\Column(name="idProgramme", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprogramme;

    /**
     * @var string
     *
     * @ORM\Column(name="objectifProgramme", type="string", length=30, nullable=false)
     */
    private $objectifprogramme;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionProgramme", type="string", length=255, nullable=false)
     */
    private $descriptionprogramme;

    /**
     * @var string
     *
     * @ORM\Column(name="nomProgramme", type="string", length=20, nullable=false)
     */
    private $nomprogramme;

    /**
     * @var string
     *
     * @ORM\Column(name="categorieProgramme", type="string", length=50, nullable=false)
     */
    private $categorieprogramme;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idExercice", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $idexercice = NULL;

    public function getIdprogramme(): ?int
    {
        return $this->idprogramme;
    }

    public function getObjectifprogramme(): ?string
    {
        return $this->objectifprogramme;
    }

    public function setObjectifprogramme(string $objectifprogramme): self
    {
        $this->objectifprogramme = $objectifprogramme;

        return $this;
    }

    public function getDescriptionprogramme(): ?string
    {
        return $this->descriptionprogramme;
    }

    public function setDescriptionprogramme(string $descriptionprogramme): self
    {
        $this->descriptionprogramme = $descriptionprogramme;

        return $this;
    }

    public function getNomprogramme(): ?string
    {
        return $this->nomprogramme;
    }

    public function setNomprogramme(string $nomprogramme): self
    {
        $this->nomprogramme = $nomprogramme;

        return $this;
    }

    public function getCategorieprogramme(): ?string
    {
        return $this->categorieprogramme;
    }

    public function setCategorieprogramme(string $categorieprogramme): self
    {
        $this->categorieprogramme = $categorieprogramme;

        return $this;
    }

    public function getIdexercice(): ?int
    {
        return $this->idexercice;
    }

    public function setIdexercice(?int $idexercice): self
    {
        $this->idexercice = $idexercice;

        return $this;
    }


}
