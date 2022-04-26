<?php

namespace App\Metiers;

use App\Entity\Caracteristiquesportif;

class calculsMetier
{
    public function calcul(Caracteristiquesportif $csp){

        $csp->setBesoinProteine(($csp->getPoidSportif()*2));
        $csp ->setBesoinCarb((6.3 * $csp->getPoidSportif() + 3.25 * $csp->getTailleSportif() - 10 * $csp->getAgeSportif() + 2));
        $csp ->setBmiSportif(round($csp->getPoidSportif() / ((($csp->getTailleSportif()/100)**2 )),2));
        if ($csp->getSexe()=="Femme"){
            $csp-> setBesoinCalories(((10*$csp->getPoidSportif()) + 6.25 *$csp->getTailleSportif() - 5 *$csp->getAgeSportif()- 161 ));
        }
        else{
            $csp->setBesoinCalories(((10 *$csp->getPoidSportif()) + 6.25 * $csp->getTailleSportif() - 5 *$csp->getAgeSportif() + 5 ));
        }
        return $csp;
    }

}