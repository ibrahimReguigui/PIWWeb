<?php

namespace App\Form;

use App\Entity\RechercheProgramme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('RechercheProgNom')
            ->add('RechercheProgCate')
            //->add('RechercheProgObj')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheProgramme::class,
        ]);
    }
}
