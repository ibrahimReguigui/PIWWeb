<?php

namespace App\Form;

use App\Entity\Abonnement;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dDebut',DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime()
            ])
            ->add('dFin',DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime()
            ])
            ->add('idSalle',EntityType::class,['label' => 'salle','class'=>Utilisateur::class,'required'=>true,'choice_label'=>'nom','multiple'=>false])
            ->add('idSportif',EntityType::class,['label' => 'salle','class'=>Utilisateur::class,'required'=>true,'choice_label'=>'nom','multiple'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,
        ]);
    }
}
