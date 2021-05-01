<?php

namespace App\Form\Customs;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class FloatType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'scale' => 2,
            'attr'  => [
                'min' => 0,
                'step' => 0.05,
                'max' => 1000
            ],
            'help' => 'Exemple: 25,85',
            'help_attr' => ['class' => 'form-helper']
        ]);
    }

    public function getParent()
    {
        return NumberType::class;
    }
}