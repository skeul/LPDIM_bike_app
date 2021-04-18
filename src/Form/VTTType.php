<?php

namespace App\Form;

use App\Entity\VTT;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VTTType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque')
            ->add('modele')
            ->add('poids')
            ->add('image')
            ->add('suspension_avant')
            ->add('suspension_arriere')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VTT::class,
        ]);
    }
}
