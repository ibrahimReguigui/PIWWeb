<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement")
 * @ORM\Entity
 */
class Abonnement
{
    /**
     * @var int
     *
     * @ORM\Column(name="idSalle", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsalle;

    /**
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dDebut", type="date", nullable=false)
     */
    private $ddebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dFin", type="date", nullable=false)
     */
    private $dfin;

    public function getIdsalle(): ?int
    {
        return $this->idsalle;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getDdebut(): ?\DateTimeInterface
    {
        return $this->ddebut;
    }

    public function setDdebut(\DateTimeInterface $ddebut): self
    {
        $this->ddebut = $ddebut;

        return $this;
    }

    public function getDfin(): ?\DateTimeInterface
    {
        return $this->dfin;
    }

    public function setDfin(\DateTimeInterface $dfin): self
    {
        $this->dfin = $dfin;

        return $this;
    }


}
