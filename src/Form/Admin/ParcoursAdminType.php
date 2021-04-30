<?php

namespace App\Form\Admin;

use App\Entity\Sommet;
use App\Entity\Parcours;
use App\Form\Customs\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ParcoursAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 3])],
            ])
            ->add('distance', FloatType::class, [
                'required' => true,
            ])
            ->add('difficulte', IntegerType::class, [
                'required' => true,
                'help' => '1 Super facile - 10 : Super difficle',
                'help_attr' => ['class' => 'form-helper'],
                'attr'  => [
                    'min' => 1,
                    'step' => 1,
                    'max' => 10
                ],
            ])
            ->add('sommet', EntityType::class, [
                'class' => Sommet::class,
                'required' => true,
                'multiple' => true,
                'expanded' => false,
                'attr' => ['class' => 'selector-multiple'],
                'help' => 'Vous pouvez sélectionner plusieurs sommtes pour votre parcours',
                'help_attr' => ['class' => 'form-helper'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parcours::class,
        ]);
    }
}