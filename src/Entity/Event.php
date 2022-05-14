<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 *
 * @ORM\Table(name="event")
 * @ORM\Entity
 */
    class Event
{
    /**
     * @var int
     *
     * @ORM\Column(name="idevent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Groups("post:read")
     */
    private $idevent;

    /**
     * @var string
     *@Groups("post:read")
     * @ORM\Column(name="nomevent", type="string", length=20, nullable=false)
     *      * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters"
     * )
     */
    private $nomevent;

    /**
     * @var \DateTime
     *@Groups("post:read")
     * @ORM\Column(name="DateDebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime
     *@Groups("post:read")
     * @ORM\Column(name="DateFin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var int
     *@Groups("post:read")
     * @ORM\Column(name="nbrPlaces", type="integer", nullable=false)
     */
    private $nbrplaces;

    /**
     * @var string
     *@Groups("post:read")
     * @ORM\Column(name="location", type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @ORM\Column(name="img", length=255, nullable=false)
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/jpg", "application/png", "application/jpeg", "application/gif"},
     *     mimeTypesMessage = "Please upload a valid IMAGE"
     * )
     * @Groups("post:read")
     */

    private $img;

    /**
     * @ORM\OneToMany(targetEntity=Ticket::class, mappedBy="Event")
     */
    private $ticket;
  

    public function getIdevent(): ?int
    {
        return $this->idevent;
    }

    public function getNomevent(): ?string
    {
        return $this->nomevent;
    }

    public function setNomevent(string $nomevent): self
    {
        $this->nomevent = $nomevent;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getNbrplaces(): ?int
    {
        return $this->nbrplaces;
    }

    public function setNbrplaces(int $nbrplaces): self
    {
        $this->nbrplaces = $nbrplaces;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(File $img = null): self
    {
        $this->img = $img;

        return $this;
    }


    /**
     * @return Collection<int, Ticket>
     */
    public function getTicket(): Collection
    {
        return $this->ticket;
    }

    public function addTicket(Ticket $evenement): self
    {
        if (!$this->ticket->contains($evenement)) {
            $this->ticket[] = $evenement;
            $evenement->setEvent($this);
        }

        return $this;
    }
    public function removeTicket(Ticket $ticket): self
    {
        if ($this->ticket->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getEvent() === $this) {
                $ticket->setEvent(null);
            }
        }
        return $this;
    }


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('nomevent', new Assert\Regex([
            'pattern' => '/\d/',
            'match' => false,
            'message' => 'Your name cannot contain a number',
        ]));

        $metadata->addPropertyConstraint('img', new Assert\File([
            'maxSize' => '1024k',
            'mimeTypes' => [
                'application/jpg',
                'application/png',
                'application/jpeg',
                'application/gif',
            ],
            'mimeTypesMessage' => 'Please upload a valid IMAGE',
        ]));
    }

    public function setAllDay($allDay)
    {
        $allDay= true;
        echo $allDay;
    }

    public function setBackgroundColor($backgroundColor)
    {

    }

    public function setBorderColor($borderColor)
    {
    }

}
