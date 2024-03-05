<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Fighter;
use App\Entity\Organisation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Fighter1Type extends AbstractType
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
            ->add('organisation', EntityType::class, [
                'class' => Organisation::class,
                'choice_label' => 'name',
            ])
            ->add('Category', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fighter::class,
        ]);
    }
}
