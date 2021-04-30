<?php

namespace App\Form\Admin;

use App\Entity\Sommet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SommetAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 3])],
            ])
            ->add('altitude', IntegerType::class, [
                'required' => true,
                'attr' => [
                    'min' => 0,
                    'step' => 1,
                    'max' => 4000,
                ]
            ])
            ->add('lieu', TextType::class, [
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sommet::class,
        ]);
    }
}