<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Courssalle
 *
 * @ORM\Table(name="courssalle", indexes={@ORM\Index(name="idSalle", columns={"idSalle"})})
 * @ORM\Entity
 */
class Courssalle
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCour", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcour;

    /**
     * @var int
     *
     * @ORM\Column(name="idSalle", type="integer", nullable=false)
     */
    private $idsalle;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCour", type="string", length=20, nullable=false)
     */
    private $nomcour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tCour", type="time", nullable=false)
     */
    private $tcour;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrTotal", type="integer", nullable=false)
     */
    private $nbrtotal;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=40, nullable=false)
     */
    private $info;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrActuel", type="integer", nullable=false)
     */
    private $nbractuel;

    public function getIdcour(): ?int
    {
        return $this->idcour;
    }

    public function getIdsalle(): ?int
    {
        return $this->idsalle;
    }

    public function setIdsalle(int $idsalle): self
    {
        $this->idsalle = $idsalle;

        return $this;
    }

    public function getNomcour(): ?string
    {
        return $this->nomcour;
    }

    public function setNomcour(string $nomcour): self
    {
        $this->nomcour = $nomcour;

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

    public function getTcour(): ?\DateTimeInterface
    {
        return $this->tcour;
    }

    public function setTcour(\DateTimeInterface $tcour): self
    {
        $this->tcour = $tcour;

        return $this;
    }

    public function getNbrtotal(): ?int
    {
        return $this->nbrtotal;
    }

    public function setNbrtotal(int $nbrtotal): self
    {
        $this->nbrtotal = $nbrtotal;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getNbractuel(): ?int
    {
        return $this->nbractuel;
    }

    public function setNbractuel(int $nbractuel): self
    {
        $this->nbractuel = $nbractuel;

        return $this;
    }


}
