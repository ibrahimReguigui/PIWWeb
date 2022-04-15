<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristiquesportif
 *
 * @ORM\Table(name="caracteristiquesportif", indexes={@ORM\Index(name="idSportif", columns={"idSportif"})})
 * @ORM\Entity
 */
class Caracteristiquesportif
{
    /**
     * @var int
     *
     * @ORM\Column(name="idCaracterisitque", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcaracterisitque;

    /**
     * @var int
     *
     * @ORM\Column(name="idSportif", type="integer", nullable=false)
     */
    private $idsportif;

    /**
     * @var float
     *
     * @ORM\Column(name="tailleSportif", type="float", precision=10, scale=0, nullable=false)
     */
    private $taillesportif;

    /**
     * @var float
     *
     * @ORM\Column(name="poidSportif", type="float", precision=10, scale=0, nullable=false)
     */
    private $poidsportif;

    /**
     * @var int
     *
     * @ORM\Column(name="ageSportif", type="integer", nullable=false)
     */
    private $agesportif;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=15, nullable=false)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="objectifNutrition", type="string", length=50, nullable=false)
     */
    private $objectifnutrition;

    /**
     * @var float
     *
     * @ORM\Column(name="bmiSportif", type="float", precision=10, scale=0, nullable=false)
     */
    private $bmisportif;

    /**
     * @var float
     *
     * @ORM\Column(name="besoinProteine", type="float", precision=10, scale=0, nullable=false)
     */
    private $besoinproteine;

    /**
     * @var float
     *
     * @ORM\Column(name="besoinCarb", type="float", precision=10, scale=0, nullable=false)
     */
    private $besoincarb;

    /**
     * @var int
     *
     * @ORM\Column(name="besoinCalories", type="integer", nullable=false)
     */
    private $besoincalories;

    /**
     * @var float
     *
     * @ORM\Column(name="besoinFat", type="float", precision=10, scale=0, nullable=false)
     */
    private $besoinfat;

    public function getIdcaracterisitque(): ?int
    {
        return $this->idcaracterisitque;
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

    public function getTaillesportif(): ?float
    {
        return $this->taillesportif;
    }

    public function setTaillesportif(float $taillesportif): self
    {
        $this->taillesportif = $taillesportif;

        return $this;
    }

    public function getPoidsportif(): ?float
    {
        return $this->poidsportif;
    }

    public function setPoidsportif(float $poidsportif): self
    {
        $this->poidsportif = $poidsportif;

        return $this;
    }

    public function getAgesportif(): ?int
    {
        return $this->agesportif;
    }

    public function setAgesportif(int $agesportif): self
    {
        $this->agesportif = $agesportif;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getObjectifnutrition(): ?string
    {
        return $this->objectifnutrition;
    }

    public function setObjectifnutrition(string $objectifnutrition): self
    {
        $this->objectifnutrition = $objectifnutrition;

        return $this;
    }

    public function getBmisportif(): ?float
    {
        return $this->bmisportif;
    }

    public function setBmisportif(float $bmisportif): self
    {
        $this->bmisportif = $bmisportif;

        return $this;
    }

    public function getBesoinproteine(): ?float
    {
        return $this->besoinproteine;
    }

    public function setBesoinproteine(float $besoinproteine): self
    {
        $this->besoinproteine = $besoinproteine;

        return $this;
    }

    public function getBesoincarb(): ?float
    {
        return $this->besoincarb;
    }

    public function setBesoincarb(float $besoincarb): self
    {
        $this->besoincarb = $besoincarb;

        return $this;
    }

    public function getBesoincalories(): ?int
    {
        return $this->besoincalories;
    }

    public function setBesoincalories(int $besoincalories): self
    {
        $this->besoincalories = $besoincalories;

        return $this;
    }

    public function getBesoinfat(): ?float
    {
        return $this->besoinfat;
    }

    public function setBesoinfat(float $besoinfat): self
    {
        $this->besoinfat = $besoinfat;

        return $this;
    }


}
