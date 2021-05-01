<?php

namespace App\Form;

use App\Entity\VTT;
use App\Form\Customs\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class VTTType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 3])],
            ])
            ->add('modele', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 3])],
            ])
            ->add('poids', FloatType::class, [
                'required' => true,
            ])
            ->add('image', UrlType::class, [
                'required' => false,
                'constraints' => [new Length(['min' => 3])],
            ])
            ->add('suspension_avant', IntegerType::class, [
                'required' => true,
                'attr'  => [
                    'min' => 50,
                    'step' => 10,
                    'max' => 250
                ],
            ])
            ->add('suspension_arriere', IntegerType::class, [
                'required' => true,
                'attr'  => [
                    'min' => 50,
                    'step' => 10,
                    'max' => 250
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VTT::class,
        ]);
    }
}