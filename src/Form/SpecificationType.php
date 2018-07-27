<?php

namespace App\Form;

use App\Entity\Specification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sp1',TextType::class, [
                'attr' => array(
                    'class' => 'horizontal1'
                )
            ])
            ->add('sp2',TextType::class, [
                'attr' => array(
                    'class' => 'horizontal1'
                )
            ])
            ->add('sp3',TextType::class, [
                'attr' => array(
                    'class' => 'horizontal1'
                )
            ])
            ->add('sp4',TextType::class, [
                'attr' => array(
                    'class' => 'horizontal2'
                )
            ])
            ->add('sp5',TextType::class, [
                'attr' => array(
                    'class' => 'horizontal2'
                )
            ])
            ->add('sp6',TextType::class, [
                'attr' => array(
                    'class' => 'horizontal2'
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Specification::class,
            'attr' => array(
                'class' => 'row'
            )
        ]);
    }
}
