<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=20, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=40, nullable=false)
     */
    private $adresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date", nullable=false)
     */
    private $datenaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseMail", type="string", length=255, nullable=false)
     */
    private $adressemail;

    /**
     * @var string
     *
     * @ORM\Column(name="motDePasse", type="string", length=255, nullable=false)
     */
    private $motdepasse;

    /**
     * @var string
     *
     * @ORM\Column(name="whoami", type="string", length=20, nullable=false)
     */
    private $whoami;

    /**
     * @var string
     *
     * @ORM\Column(name="numTel", type="string", length=22, nullable=false)
     */
    private $numtel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="blocRaison", type="string", length=20, nullable=true, options={"default"="NULL"})
     */
    private $blocraison = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="unbloc", type="date", nullable=true, options={"default"="NULL"})
     */
    private $unbloc = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="blob", length=16777215, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getAdressemail(): ?string
    {
        return $this->adressemail;
    }

    public function setAdressemail(string $adressemail): self
    {
        $this->adressemail = $adressemail;

        return $this;
    }

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getWhoami(): ?string
    {
        return $this->whoami;
    }

    public function setWhoami(string $whoami): self
    {
        $this->whoami = $whoami;

        return $this;
    }

    public function getNumtel(): ?string
    {
        return $this->numtel;
    }

    public function setNumtel(string $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }

    public function getBlocraison(): ?string
    {
        return $this->blocraison;
    }

    public function setBlocraison(?string $blocraison): self
    {
        $this->blocraison = $blocraison;

        return $this;
    }

    public function getUnbloc(): ?\DateTimeInterface
    {
        return $this->unbloc;
    }

    public function setUnbloc(?\DateTimeInterface $unbloc): self
    {
        $this->unbloc = $unbloc;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }


}
