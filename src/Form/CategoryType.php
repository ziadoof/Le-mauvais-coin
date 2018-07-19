<?php

namespace App\Form;

use App\Entity\Category;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Form\AnnonceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('class', TextType::class)
            ->add('sp1', TextType::class)
            ->add('sp2', TextType::class)
            ->add('sp3', TextType::class)
            ->add('sp4', TextType::class)
            ->add('sp5', IntegerType::class)
            ->add('sp6', IntegerType::class)
            ->add('annonce', CollectionType::class,[
                'entry_type' => AnnonceType::class,
                'entry_options' => [
                    'label' => false
                ],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
