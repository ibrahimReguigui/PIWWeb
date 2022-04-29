<?php

namespace App\Entity;
/* 
use App\Repository\RechercheExerciceRepository;
use Doctrine\ORM\Mapping as ORM; */


class RechercheExercice
{
    
    private $id;

    
    private $RechercheNom;


    private $RechercheCategorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRechercheNom(): ?string
    {
        return $this->RechercheNom;
    }

    public function setRechercheNom(string $RechercheNom): self
    {
        $this->RechercheNom = $RechercheNom;

        return $this;
    }

    public function getRechercheCategorie(): ?string
    {
        return $this->RechercheCategorie;
    }

    public function setRechercheCategorie(string $RechercheCategorie): self
    {
        $this->RechercheCategorie = $RechercheCategorie;

        return $this;
    }
}
