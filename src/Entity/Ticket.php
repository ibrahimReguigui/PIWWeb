<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Event;
use Symfony\Component\Validator\Mapping\ClassMetadata;
/**
 * Ticket
 *
 * @ORM\Table(name="ticket", indexes={@ORM\Index(name="idevent", columns={"idEvent"})})
 * @ORM\Entity
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ticket", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id_Ticket;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="ticket")
     * @ORM\JoinColumn(name="idevent", referencedColumnName="idEvent")
     */
    private $Event;

    public function getIdTicket(): ?int
    {
        return $this->id_Ticket;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


    public function setIdTicket(?Ticket $ticket): self
    {
        $this->Ticket = $ticket;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->Event;
    }

    /**
     * @param mixed $Event
     */
    public function setEvent($Event): void
    {
        $this->Event = $Event;
    }

}
