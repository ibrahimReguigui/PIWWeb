<?php

namespace App\Form;

use App\Entity\Caracteristiquesportif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class CaracType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tailleSportif')
            ->add('poidSportif')
            ->add('ageSportif')

            ->add('sexe', ChoiceType::class,[
                'choices'=>[
                    'Homme'=>"Homme",
                    'Femme'=>"Femme",
                ],
            ])

            ->add('objectifNutrition', ChoiceType::class,[
                'choices'=>[
                    'Gain de poid'=>"Gain de poid",
                    'Pert de poid'=>"Pert de poid",

                ],
            ])

            ->add('ajouter', SubmitType::class)




        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Caracteristiquesportif::class,
        ]);
    }
}
