<?php

namespace App\Form;

use App\Entity\Evenement;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Devise;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('debutAt')
            ->add('finAt')
            ->add('prix')
            ->add('devises',EntityType::class ,[
                'class' => Devise::class,
                'choice_label' => 'titre'
            ])
            ->add('nbrPlace')
            ->add('image', FileType::class, array(
                'label' => 'Upload images de l evenement'
            ))
            ->add('category', EntityType::class ,[
                'class' => Category::class,
                'choice_label' => 'titre'
                ])
            ->add('description')
            ->add('lieux')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
