<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plat
 *
 * @ORM\Table(name="plat", indexes={@ORM\Index(name="idSportif", columns={"idSportif"})})
 * @ORM\Entity
 */
class Plat
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPlat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idplat;

    /**
     * @var int
     *
     * @ORM\Column(name="idSportif", type="integer", nullable=false)
     */
    private $idsportif;

    /**
     * @var string
     *
     * @ORM\Column(name="detail", type="string", length=60, nullable=false)
     */
    private $detail;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrCalories", type="integer", nullable=false)
     */
    private $nbrcalories;

    public function getIdplat(): ?int
    {
        return $this->idplat;
    }

    public function getIdsportif(): ?int
    {
        return $this->idsportif;
    }

    public function setIdsportif(int $idsportif): self
    {
        $this->idsportif = $idsportif;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    public function getNbrcalories(): ?int
    {
        return $this->nbrcalories;
    }

    public function setNbrcalories(int $nbrcalories): self
    {
        $this->nbrcalories = $nbrcalories;

        return $this;
    }


}
