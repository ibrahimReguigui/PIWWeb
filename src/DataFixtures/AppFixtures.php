<?php

namespace App\DataFixtures;

use App\Entity\Exercice;
use App\Entity\Programme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        $ex1 = new Exercice ; 
        $ex1->setNomExercice("exercice1")
            ->setDescriptionExercice("fairecaet ca")
            ->setNbrRepetition(10)
            ->setNbrSerie(4)
            ->setCategorieExercice("poitrine") ;
            $manager->persist($ex1);

            $ex2 = new Exercice ; 
            $ex2->setNomExercice("exercice2")
                ->setDescriptionExercice("paramparamex")
                ->setNbrRepetition(13)
                ->setNbrSerie(5)
                ->setCategorieExercice("bras") ;
                $manager->persist($ex2);



                $p1 = new Programme ;
                $p1 ->setNomProgramme("Press de mass")
                    ->setObjectifProgramme("perdre de poids")
                    ->setDescriptionProgramme("go to squad for jambe")
                    ->setCategorieProgramme("bras")
                    ->setExercices($ex1);
                    $manager->persist($p1) ;
 
 
                    $p2 = new Programme ;
                    $p2 ->setNomProgramme("only mass")
                        ->setObjectifProgramme("musculaire")
                        ->setDescriptionProgramme("crossfit")
                        ->setCategorieProgramme("poitrine")
                        ->setExercices($ex2);
                        $manager->persist($p2) ;
     
                        $programmes = [$p1,$p2];
        $faker = \Faker\Factory::create('fr_FR');
        foreach($programmes as $p){

            $rand = rand(3,5);
            for($i=1 ;$i <= $rand;$i++){
                $programme = new Programme();
                $programme->setNomProgramme($faker->regexify("[A-Z]{4}"))
                            ->setObjectifProgramme($faker->regexify("[A-Z]{5}"))
                            ->setDescriptionProgramme($faker->regexify("[A-Z]{6}"))
                            ->setCategorieProgramme($faker->regexify("[A-Z]{7}"))
                            ->setExercices($faker->randomDigit())
                            ;
                            
                            $manager ->persist($programme) ;
                            
                

            }
        }


        $manager->flush();
    }
}
