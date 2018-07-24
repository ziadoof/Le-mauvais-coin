<?php

namespace App\Form;

use App\Entity\Specifications;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecificationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sp1')
            ->add('sp2')
            ->add('sp3')
            ->add('sp4')
            ->add('sp5')
            ->add('sp6')
            ->add('division')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Specifications::class,
        ]);
    }
}
