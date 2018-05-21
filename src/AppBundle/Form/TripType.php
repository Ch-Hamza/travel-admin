<?php

namespace AppBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class TripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('date_depart',  DateType::class)
            ->add('date_retour', DateType::class)
            ->add('nbrPersonne', IntegerType::class)
            ->add('categorie',  ChoiceType::class, array(
                    'choices'  => array(
                        'Solo Adventure' => 'Solo Adventure',
                        'Family Trip' => 'Family Trip',
                        'Friends Trip' => 'Friends Trip',
                        'Fan Club' => 'Fan Club'
                    ))
            )
            ->add('imageFile', VichImageType::class, array(
                'download_link'     => false,
                'required'    => false,
                'allow_delete' => false,
                'image_uri' => false,
            ))
            ->add('prix', TextType::class)
            ->add('description', TextareaType::class, array(
                'attr' => array('rows' => '10'),
            ))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => \AppBundle\Entity\Trip::class,
        ));
    }
}