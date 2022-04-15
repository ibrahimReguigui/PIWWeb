<?php

namespace App\Form;

use App\Entity\CourSalle;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourSalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nomCour',TextType::class,['label' => 'Nom'])
            ->add('information',TextType::class,['label' => 'Information'])
            ->add('nbrTotal')
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime()
            ])
            ->add('tCour')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CourSalle::class,
        ]);
    }
}
