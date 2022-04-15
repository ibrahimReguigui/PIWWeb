<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Progexe
 *
 * @ORM\Table(name="progexe", indexes={@ORM\Index(name="idExercice", columns={"idExercice"}), @ORM\Index(name="idProgramme", columns={"idProgramme"})})
 * @ORM\Entity
 */
class Progexe
{
    /**
     * @var int
     *
     * @ORM\Column(name="idProgExe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprogexe;

    /**
     * @var int
     *
     * @ORM\Column(name="idProgramme", type="integer", nullable=false)
     */
    private $idprogramme;

    /**
     * @var int
     *
     * @ORM\Column(name="idExercice", type="integer", nullable=false)
     */
    private $idexercice;

    public function getIdprogexe(): ?int
    {
        return $this->idprogexe;
    }

    public function getIdprogramme(): ?int
    {
        return $this->idprogramme;
    }

    public function setIdprogramme(int $idprogramme): self
    {
        $this->idprogramme = $idprogramme;

        return $this;
    }

    public function getIdexercice(): ?int
    {
        return $this->idexercice;
    }

    public function setIdexercice(int $idexercice): self
    {
        $this->idexercice = $idexercice;

        return $this;
    }


}
