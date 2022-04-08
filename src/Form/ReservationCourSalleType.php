<?php

namespace App\Form;

use App\Entity\CourSalle;
use App\Entity\ReservationCourSalle;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationCourSalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idSalle', EntityType::class,['label' => 'salle','class'=>Utilisateur::class,'required'=>true,'choice_label'=>'nom','multiple'=>false])
            ->add('idCour',EntityType::class,['label' => 'cour','class'=>CourSalle::class,'required'=>true,'choice_label'=>'nom_cour','multiple'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationCourSalle::class,
        ]);
    }
}
