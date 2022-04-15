<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salle
 *
 * @ORM\Table(name="salle")
 * @ORM\Entity
 */
class Salle
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
     * @var string
     *
     * @ORM\Column(name="nomSalle", type="string", length=20, nullable=false)
     */
    private $nomsalle;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseSalle", type="string", length=30, nullable=false)
     */
    private $adressesalle;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseMailSalle", type="string", length=30, nullable=false)
     */
    private $adressemailsalle;

    /**
     * @var string
     *
     * @ORM\Column(name="motDePasseSalle", type="string", length=20, nullable=false)
     */
    private $motdepassesalle;

    public function getIdsalle(): ?int
    {
        return $this->idsalle;
    }

    public function getNomsalle(): ?string
    {
        return $this->nomsalle;
    }

    public function setNomsalle(string $nomsalle): self
    {
        $this->nomsalle = $nomsalle;

        return $this;
    }

    public function getAdressesalle(): ?string
    {
        return $this->adressesalle;
    }

    public function setAdressesalle(string $adressesalle): self
    {
        $this->adressesalle = $adressesalle;

        return $this;
    }

    public function getAdressemailsalle(): ?string
    {
        return $this->adressemailsalle;
    }

    public function setAdressemailsalle(string $adressemailsalle): self
    {
        $this->adressemailsalle = $adressemailsalle;

        return $this;
    }

    public function getMotdepassesalle(): ?string
    {
        return $this->motdepassesalle;
    }

    public function setMotdepassesalle(string $motdepassesalle): self
    {
        $this->motdepassesalle = $motdepassesalle;

        return $this;
    }


}
