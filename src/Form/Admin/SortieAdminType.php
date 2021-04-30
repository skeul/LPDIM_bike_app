<?php

namespace App\Form\Admin;

use App\Entity\Sortie;
use App\Entity\Parcours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class SortieAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 3])],
            ])
            ->add('date_sortie', DateTimeType::class, [
                'widget' => 'choice',
                // prevents rendering it as type="date", to avoid HTML5 date pickers
                'html5' => false,

            ])
            ->add('status', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'attr' => ['class' => 'selector'],
                'choices'  => [
                    '1' => 'Programée',
                    '2' => 'Réalisée',
                ],
            ])
            ->add('parcours', EntityType::class, [
                'class' => Parcours::class,
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'attr' => ['class' => 'selector']
            ])
            ->add('users');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}