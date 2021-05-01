<?php

namespace App\Form\Admin;

use App\Entity\User;
use App\Entity\Sortie;
use App\Entity\Parcours;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Security\Core\Security;
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
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->security->getUser();
        $builder
            ->add('nom', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 3])],
            ])
            ->add('date_sortie', DateTimeType::class, [
                'widget' => 'choice',
                'html5' => false,

            ])
            ->add('status', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'attr' => ['class' => 'selector'],
                'choices'  => [
                    'Programée' => 1,
                    'Réalisée' => 2,
                ],
            ])
            ->add('parcours', EntityType::class, [
                'class' => Parcours::class,
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'attr' => ['class' => 'selector']
            ])
            ->add('users', EntityType::class, [
                'label' => 'Amis',
                'class' => User::class,
                'multiple' => true,
                'expanded' => true,
                'attr' => ['class' => 'selector-multiple'],
                'help' => 'Vous pouvez ajouter plusieurs personnes pour votre sortie',
                'help_attr' => ['class' => 'form-helper'],
                'choices' => $user->getAmis(),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}