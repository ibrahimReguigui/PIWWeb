<?php

namespace App\Entity;

use App\Repository\SallesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SallesRepository::class)
 */
class Salles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NomSalle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSalle(): ?string
    {
        return $this->NomSalle;
    }

    public function setNomSalle(string $NomSalle): self
    {
        $this->NomSalle = $NomSalle;

        return $this;
    }
}
