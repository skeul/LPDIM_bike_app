<?php

namespace App\Form;

use App\Entity\Electric;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElectricType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque')
            ->add('modele')
            ->add('poids')
            ->add('image')
            ->add('puissance')
            ->add('autonomie')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Electric::class,
        ]);
    }
}
