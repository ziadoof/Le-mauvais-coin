<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Division;
use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title')
            ->add('description')
            ->add('price');
            //->add('photos')
       $builder
           ->add('category', EntityType::class, [
               'class'       => 'App\Entity\Category',
               'placeholder' => 'Sélectionnez un category',
               'mapped'      => false,
               'required'    => false
           ]);

        $builder->get('category')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addDivisionField($form->getParent(), $form->getData());
            }
        );
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
                /* @var $division Division */
                $division = $data->getDivision();
                $form = $event->getForm();
                if ($division) {
                    // On récupère le département et la région
                    $category = $division->getCategory();

                    // On crée les 2 champs supplémentaires

                    $this->addDivisionField($form, $category);
                    // On set les données

                    $form->get('category')->setData($category);
                } else {
                    // On crée les 2 champs en les laissant vide (champs utilisé pour le JavaScript)
                    $this->addDivisionField($form, null);
                }
            }
        );


    }


    /*
    * Rajout un champs division au formulaire
    * @param FormInterface $form
    * @param Division $division
    */
    private function addDivisionField(FormInterface $form, ?Category $category)
    {
        $form->add('division', EntityType::class, [
            'class'       => 'App\Entity\Division',
            'placeholder' => $category ? 'Sélectionnez votre division' : 'Sélectionnez votre category',
            'choices'     => $category ? $category->getDivisions() : []

        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
