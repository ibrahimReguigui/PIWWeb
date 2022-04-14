<?php

namespace App\Form;

use App\Entity\Caracteristiquesportif;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CaracType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tailleSportif')
            ->add('poidSportif')
            ->add('ageSportif')
            ->add('sexe')
            ->add('objectifNutrition')
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
