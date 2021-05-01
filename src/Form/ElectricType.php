<?php

namespace App\Form;

use App\Entity\Electric;
use App\Form\Customs\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ElectricType extends AbstractType
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
            ->add('puissance', IntegerType::class, [
                'required' => true,
                'attr'  => [
                    'min' => 0,
                    'step' => 10,
                    'max' => 50000
                ],
            ])
            ->add('autonomie', FloatType::class, [
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Electric::class,
        ]);
    }
}