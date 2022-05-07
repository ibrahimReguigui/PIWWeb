<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Category;
use Symfony\Component\Validator\Constraints\File;





class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('marque')
            ->add('prix')
            ->add('description')
            ->add('image', FileType::class, array('label' => 'Image ','data_class' => null))
            ->add('disponibilite')
            ->add('quantite')
            ->add('category', EntityType::class, ['class' => Category::class,
                'choice_label' => 'name', 'label' => 'Category'])

            ;

    }
        public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
