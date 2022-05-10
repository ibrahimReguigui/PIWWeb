<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
 class User implements  UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups("post:read")
     * @Assert\NotBlank(message="Nom obligatoire !" )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups("post:read")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("post:read")
     * @Assert\NotBlank(message="Adresse obligatoire !" )
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=8)
     * @Groups("post:read")
     * @Assert\NotBlank(message="Numéro de téléphone obligatoire !" )
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = " Num° de téléphone doit être égale à {{ limit }} charactères",
     *      maxMessage = "Num° de téléphone doit être égale à {{ limit }} charactères"
     * )
     */
    private $numTel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post:read")
     * @Assert\NotBlank(message="Mot de passe obligatoire !" )
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = " Votre mot de passe doit depassé {{ limit }} charactères",
     *      maxMessage = "Votre mot de passe ne doit pas depassé {{ limit }} charactères"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups("post:read")
     * @Assert\NotBlank(message="Email obligatoire !" )
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email!")
     */
    private $mailAdress;

    /**
     * @ORM\Column(type="date")
     * @Groups("post:read")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=20)
     * @Groups("post:read")
     * @Assert\NotBlank(message="qui êtes-vous?" )
     */
    private $whoami;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups("post:read")
     */
    private $blocRaison;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("post:read")
     */
    private $unbloc;


     /**
      * @ORM\Column(type="string", length=255)
      * @Groups("post:read")
      * @Assert\File(mimeTypes={"image/jpeg"})
      */
     private $image;


     /**
      * @ORM\Column(type="boolean", nullable=false)
      * @Groups("post:read")
      */
     private $isconnected;


     /**
      * @ORM\Column(type="integer", nullable=true)
      * @Groups("post:read")
      */
     private $nbsignal;



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

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getMailAdress(): ?string
    {
        return $this->mailAdress;
    }

    public function setMailAdress(string $mailAdress): self
    {
        $this->mailAdress = $mailAdress;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

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

    public function getBlocRaison(): ?string
    {
        return $this->blocRaison;
    }

    public function setBlocRaison(?string $blocRaison): self
    {
        $this->blocRaison = $blocRaison;

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

     public function getRoles()
     {
         // TODO: Implement getRoles() method.
     }

     public function getSalt()
     {
         // TODO: Implement getSalt() method.
     }

     public function getUsername()
     {
         // TODO: Implement getUsername() method.
     }

     public function eraseCredentials()
     {
         // TODO: Implement eraseCredentials() method.
     }



     protected $captchaCode;

     public function getCaptchaCode()
     {
         return $this->captchaCode;
     }

     public function setCaptchaCode($captchaCode)
     {
         $this->captchaCode = $captchaCode;
     }


     public function getImage()
     {
         return $this->image;
     }

     public function setImage($image)
     {
         $this->image = $image;
         return $this;
     }



     public function getIsconnected(): ?bool
     {
         return $this->isconnected;
     }

     public function setIsconnected(?bool $isconnected): self
     {
         $this->isconnected = $isconnected;

         return $this;
     }


     public function getNbSignal()
     {
         return $this->nbsignal;
     }

     public function setNbsignal($nbsignal)
     {
         $this->nbsignal = $nbsignal;
         return $this;
     }




 }
