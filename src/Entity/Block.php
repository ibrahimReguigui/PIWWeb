<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BlockRepository::class)
 */
class Block
{

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="Merci de citer le raison" )

     */
    private $blocRaison;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotBlank(message="Merci de citer la date de déblocage" )

     */
    private $unbloc;


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



    protected $captchaCod;

    public function getCaptchaCod()
    {
        return $this->captchaCod;
    }

    public function setCaptchaCod($captchaCode)
    {
        $this->captchaCod = $captchaCode;
    }

}
