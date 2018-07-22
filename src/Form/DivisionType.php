<?php

namespace App\Form;

use App\Entity\Division;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DivisionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('sp1')
            ->add('sp2')
            ->add('sp3')
            ->add('sp4')
            ->add('sp5')
            ->add('sp6')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Division::class,
        ]);
    }
}
