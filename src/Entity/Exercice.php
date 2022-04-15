<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ExerciceRepository::class)
 */
class Exercice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

   /**
     * @Assert\NotBlank(message=" Nom doit etre non vide")
     * @Assert\Length(
     *      min = 4,
     *      minMessage=" Entrer un titre au mini de 4 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=100)
     */
    private $nomExercice;

    /**
     * @Assert\NotBlank(message="description  doit etre non vide")
     * @Assert\Length(
     *      min = 7,
     *      max = 100,
     *      minMessage = "doit etre >=7 ",
     *      maxMessage = "doit etre <=100" )
     * @ORM\Column(type="string", length=200)
     */
    private $descriptionExercice;

    /**
     * @Assert\NotBlank(message="Categorie  doit etre non vide")
     * @ORM\Column(type="string", length=200)
     */
    private $categorieExercice;

    /**
     * @Assert\NotBlank(message="Nombre de repetition  doit etre non vide")
    * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @ORM\Column(type="integer")
     */
    private $nbrRepetition;

    /**
     * @Assert\NotBlank(message="Nombre de Serie  doit etre non vide")
    * @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @ORM\Column(type="integer")
     */
    private $nbrSerie;

    /**
     * @ORM\OneToMany(targetEntity=programme::class, mappedBy="exercices")
     */
    private $programmes;

    public function __construct()
    {
        $this->programmes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomExercice(): ?string
    {
        return $this->nomExercice;
    }

    public function setNomExercice(string $nomExercice): self
    {
        $this->nomExercice = $nomExercice;

        return $this;
    }

    public function getDescriptionExercice(): ?string
    {
        return $this->descriptionExercice;
    }

    public function setDescriptionExercice(string $descriptionExercice): self
    {
        $this->descriptionExercice = $descriptionExercice;

        return $this;
    }

    public function getCategorieExercice(): ?string
    {
        return $this->categorieExercice;
    }

    public function setCategorieExercice(string $categorieExercice): self
    {
        $this->categorieExercice = $categorieExercice;

        return $this;
    }

    public function getNbrRepetition(): ?int
    {
        return $this->nbrRepetition;
    }

    public function setNbrRepetition(int $nbrRepetition): self
    {
        $this->nbrRepetition = $nbrRepetition;

        return $this;
    }

    public function getNbrSerie(): ?int
    {
        return $this->nbrSerie;
    }

    public function setNbrSerie(int $nbrSerie): self
    {
        $this->nbrSerie = $nbrSerie;

        return $this;
    }

    /**
     * @return Collection<int, programme>
     */
    public function getProgrammes(): Collection
    {
        return $this->programmes;
    }

    public function addProgramme(programme $programme): self
    {
        if (!$this->programmes->contains($programme)) {
            $this->programmes[] = $programme;
            $programme->setExercices($this);
        }

        return $this;
    }

    public function removeProgramme(programme $programme): self
    {
        if ($this->programmes->removeElement($programme)) {
            // set the owning side to null (unless already changed)
            if ($programme->getExercices() === $this) {
                $programme->setExercices(null);
            }
        }

        return $this;
    }
    public function __toString() {
        return $this->nomExercice;
    }
}
