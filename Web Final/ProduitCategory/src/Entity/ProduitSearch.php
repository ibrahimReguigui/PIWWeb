<?php
namespace App\Entity;

Class ProduitSearch{

    /**
     * @var int|null
     */
    private $maxPrice;

    /**
     * @var int|null
     */
    private $minQuantite;

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     * @return Produitsearch
     */
    public function setMaxPrice(int $maxPrice): Produitsearch
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinQuantite(): ?int
    {
        return $this->minQuantite;
    }

    /**
     * @param int|null $minQuantite
     * @return Produitsearch
     */
    public function setMinQuantite(int $minQuantite): Produitsearch
    {
        $this->minQuantite = $minQuantite;
        return $this;
    }


    private
        $nom;
    public function getNom(): ?string
    {
        return $this->nom;
}
    public function
    setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
}


}