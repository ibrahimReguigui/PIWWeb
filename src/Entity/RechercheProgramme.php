<?php

namespace App\Entity;




class RechercheProgramme
{
   
    private $id;

    private $RechercheProgNom;

  
    private $RechercheProgCate;

  
    private $RechercheProgObj;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRechercheProgNom(): ?string
    {
        return $this->RechercheProgNom;
    }

    public function setRechercheProgNom(string $RechercheProgNom): self
    {
        $this->RechercheProgNom = $RechercheProgNom;

        return $this;
    }

    public function getRechercheProgCate(): ?string
    {
        return $this->RechercheProgCate;
    }

    public function setRechercheProgCate(string $RechercheProgCate): self
    {
        $this->RechercheProgCate = $RechercheProgCate;

        return $this;
    }

    public function getRechercheProgObj(): ?string
    {
        return $this->RechercheProgObj;
    }

    public function setRechercheProgObj(string $RechercheProgObj): self
    {
        $this->RechercheProgObj = $RechercheProgObj;

        return $this;
    }
}
