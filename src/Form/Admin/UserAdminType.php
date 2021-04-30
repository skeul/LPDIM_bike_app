<?php

namespace App\Form\Admin;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 3])],
            ])
            ->add('Roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'attr' => ['class' => 'selector'],
                'choices'  => [
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'No Role' => null,
                ],
            ])
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'ajouter un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit avoir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('nom', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 1])],
            ])
            ->add('prenom', TextType::class, [
                'required' => true,
                'constraints' => [new Length(['min' => 1])],
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'attr' => array(
                    'placeholder' => 'toto@titi.com',
                )
            ]);

        // Data transformer
        $builder->get('Roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    // transform the array to a string
                    return count($rolesArray) ? $rolesArray[0] : null;
                },
                function ($rolesString) {
                    // transform the string back to an array
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}