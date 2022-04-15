<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employe
 *
 * @ORM\Table(name="employe")
 * @ORM\Entity
 */
class Employe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_emp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_emp", type="string", length=20, nullable=false)
     */
    private $nomEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_emp", type="string", length=20, nullable=false)
     */
    private $prenomEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=40, nullable=false)
     */
    private $mail;

    /**
     * @var int
     *
     * @ORM\Column(name="num_emp", type="integer", nullable=false)
     */
    private $numEmp;

    /**
     * @var float
     *
     * @ORM\Column(name="salaire", type="float", precision=10, scale=0, nullable=false)
     */
    private $salaire;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    public function getIdEmp(): ?int
    {
        return $this->idEmp;
    }

    public function getNomEmp(): ?string
    {
        return $this->nomEmp;
    }

    public function setNomEmp(string $nomEmp): self
    {
        $this->nomEmp = $nomEmp;

        return $this;
    }

    public function getPrenomEmp(): ?string
    {
        return $this->prenomEmp;
    }

    public function setPrenomEmp(string $prenomEmp): self
    {
        $this->prenomEmp = $prenomEmp;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getNumEmp(): ?int
    {
        return $this->numEmp;
    }

    public function setNumEmp(int $numEmp): self
    {
        $this->numEmp = $numEmp;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }


}
