<?php

namespace App\Entity;

use App\Repository\DisponibiliteCoachRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=DisponibiliteCoachRepository::class)
 */
class DisponibiliteCoach
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="disponibiliteCoaches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCoach;

    /**
     * @ORM\Column(type="date")
     * @Assert\GreaterThan("today",message="Date doit etre superieure a celle d'aujourdhui")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     * @Assert\NotNull
     */
    private $time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCoach(): User
    {
        return $this->idCoach;
    }

    public function setIdCoach(?User $idCoach): self
    {
        $this->idCoach = $idCoach;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }
}
