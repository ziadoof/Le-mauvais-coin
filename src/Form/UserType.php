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
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Form;
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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;


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
            ->add('telephone', TextType::class);

        $builder
            ->add('region', EntityType::class, [
            'class'       => 'App\Entity\Region',
            'placeholder' => 'Sélectionnez votre région',
            'mapped'      => false,
            'required'    => false
             ]);

        $builder->get('region')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addDepartmentField($form->getParent(), $form->getData());
            }
        );

        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
                /* @var $city City */
                $city = $data->getCity();
                $form = $event->getForm();
                if ($city) {
                    // On récupère le département et la région
                    $department = $city->getDepartment();
                    $region = $department->getRegion();
                    // On crée les 2 champs supplémentaires
                    $this->addDepartmentField($form, $region);
                    $this->addVilleField($form, $department);
                    // On set les données
                    $form->get('region')->setData($region);
                    $form->get('department')->setData($department);
                } else {
                    // On crée les 2 champs en les laissant vide (champs utilisé pour le JavaScript)
                    $this->addDepartmentField($form, null);
                    $this->addVilleField($form, null);
                }
            }
        );

    }

    /*
     * Rajout un champs department au formulaire
     * @param FormInterface $form
     * @param Region $region
     */
    private function addDepartmentField(FormInterface $form, ?Region $region)
    {
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'department',
            EntityType::class,
            null,
            [
                'class'           => 'App\Entity\Department',
                'placeholder'     => $region ? 'Sélectionnez votre département' : 'Sélectionnez votre région',
                'mapped'          => false,
                'required'        => false,
                'auto_initialize' => false,
                'choices'         => $region ? $region->getDepartments() : []
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addVilleField($form->getParent(), $form->getData());
            }
        );
        $form->add($builder->getForm());
    }

    private function addVilleField(FormInterface $form, ?Department $department)
    {
        $form->add('city', EntityType::class, [
            'class'       => 'App\Entity\City',
            'placeholder' => $department ? 'Sélectionnez votre ville' : 'Sélectionnez votre département',
            'choices'     => $department ? $department->getCitys() : []

        ]);
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}