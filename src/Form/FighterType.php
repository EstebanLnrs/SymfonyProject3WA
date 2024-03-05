<?php

namespace App\Form;

use App\Entity\Fighter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FighterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('pseudonym')
            ->add('age')
            ->add('weight')
            ->add('height')
            ->add('reach')
            ->add('stance')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fighter::class,
        ]);
    }
}
