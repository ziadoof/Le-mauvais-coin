<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 13/07/18
 * Time: 00:26
 */

namespace App\Form;


use App\Entity\Annonce;
use App\Entity\City;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Department;
use App\Entity\Region;
use Doctrine\ORM\EntityRepository;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class)
            ->add('username', TextType::class)
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('photo', TextType::class)
            ->add('telephone', TextType::class)

            ->add('city', EntityType::class, [
                'required' => false,
                'class' => City::class,
                'label' => 'city',
                'placeholder' => 'Sélectionnez votre city',
                'choice_label' => function ($name) {
                    return $name->getName();
                }
            ])

            ->add('department', EntityType::class, [
            'class'       => 'App\Entity\Department',
            'placeholder' => 'Sélectionnez votre department',
            'mapped'      => false,
            'required'    => false
            ])

            ->add('region', EntityType::class, [
                'class'       => 'App\Entity\Region',
                'placeholder' => 'Sélectionnez votre region',
                'mapped'      => false,
                'required'    => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}