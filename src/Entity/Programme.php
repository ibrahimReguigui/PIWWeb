<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ProgrammeRepository::class)
 */
class Programme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message=" Nom doit etre non vide")
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 4,
     *      minMessage=" Entrer un titre au mini de 4 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    private $nomProgramme;

    /**
     * @Assert\NotBlank(message="Objectif  doit etre non vide")
     * @Assert\NotNull
     * @ORM\Column(type="string", length=100)
     */
    private $objectifProgramme;

    /**
     * @Assert\NotBlank(message="description  doit etre non vide")
     * @Assert\Length(
     *      min = 7,
     *      max = 100,
     *      minMessage = "doit etre >=7 ",
     *      maxMessage = "doit etre <=100" )
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionProgramme;

    /**
     * @Assert\NotBlank(message="Objectif  doit etre non vide")
      * @Assert\NotNull
     * @ORM\Column(type="string", length=100)
     */
    private $categorieProgramme;

    /**
     * @Assert\NotBlank(message="description  doit etre non vide")
      * @Assert\NotNull
     * @ORM\ManyToOne(targetEntity=Exercice::class)
     * @ORM\JoinColumn(name="exercices_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $exercices;

  
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProgramme(): ?string
    {
        return $this->nomProgramme;
    }

    public function setNomProgramme(?string $nomProgramme): self
    {
        $this->nomProgramme = $nomProgramme;

        return $this;
    }

    public function getObjectifProgramme(): ?string
    {
        return $this->objectifProgramme;
    }

    public function setObjectifProgramme(?string $objectifProgramme): self
    {
        $this->objectifProgramme = $objectifProgramme;

        return $this;
    }

    public function getDescriptionProgramme(): ?string
    {
        return $this->descriptionProgramme;
    }

    public function setDescriptionProgramme(?string $descriptionProgramme): self
    {
        $this->descriptionProgramme = $descriptionProgramme;

        return $this;
    }

    public function getCategorieProgramme(): ?string
    {
        return $this->categorieProgramme;
    }

    public function setCategorieProgramme(?string $categorieProgramme): self
    {
        $this->categorieProgramme = $categorieProgramme;

        return $this;
    }

    public function getExercices(): ?Exercice
    {
        return $this->exercices;
    }

    public function setExercices(?Exercice $exercices): self
    {
        $this->exercices = $exercices;

        return $this;
    }

    public function __toString() {
        return $this->exercices;
    }

  /*   public function __toString2() {
        return ' ___Nom-Programme____ : ' . $this->getNomProgramme() ."\r\n"
        .  ' ___ Objectif-Programme ___:' . $this->getObjectifProgramme() ."\r\n"
         . '  ___Description-Programme ___ : ' . $this->getDescriptionProgramme()."\r\n"
        . ' ___Categorie-Programme ___ : ' . $this->getCategorieProgramme()."\r\n"
        . ' ___Exercice-Programme ___:' . $this->getExercices()
        
        
        
        ;
    }
 */
public function __toString2() {

$msg = 
'[+]━━━【 🏋️‍♂️ 】━━[+]  '. "\r\n" .
'[+]━━━【Nom Programme 】━━[+]  '.
$this->getNomProgramme() . "\r\n" .
'===================== ' ."\r\n" .

'[+]━━━【Objectif  Programme 】━━[+]  '.
$this->getObjectifProgramme() . "\r\n" .
'===================== ' ."\r\n".

'[+]━━━【Description  Programme 】━━[+]  '.
$this->getDescriptionProgramme() . "\r\n" .
'===================== ' ."\r\n".

'[+]━━━【Categorie Programme 】━━[+]  '.
$this->getCategorieProgramme() . "\r\n" .
'===================== ' ."\r\n".

'[+]━━━【Exercice Programme 】━━[+]  '.
$this->getExercices() . "\r\n" .
'===================== ' ."\r\n"



;

return $msg ;

}




}
