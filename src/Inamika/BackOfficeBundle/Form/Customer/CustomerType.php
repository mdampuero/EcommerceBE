<?php

//
//  Created by Mauricio Ampuero <mdampuero@gmail.com> on 2019.
//  Copyright © 2019 Inamika S.A. All rights reserved.
//

namespace Inamika\BackOfficeBundle\Form\Customer;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CustomerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',TextType::class,array('label'=>'Nombre','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'Nombre')))
        ->add('email',TextType::class,array('label'=>'Email','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'Email')))
        ->add('password',TextType::class,array('label'=>'Contraseña','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'Contraseña')))
        ->add('phone',TextType::class,array('label'=>'Teléfono','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'Teléfono')))
        ->add('address',TextType::class,array('label'=>'Dirección','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'Dirección')))
        ->add('city',TextType::class,array('label'=>'Ciudad','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'Ciudad')))
        ->add('provence',TextType::class,array('label'=>'Provincia','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'Provincia')))
        ->add('document',TextType::class,array('label'=>'DNI/CUIT/CUIL','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'DNI/CUIT/CUIL')))
        ->add('observations',TextareaType::class,array('label'=>'DESCRIPTION','label_attr'=>array('class'=>'control-label'),'attr'=>array('class'=>'form-control','placeholder'=>'DESCRIPTION')))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'=>false,
            'allow_extra_fields'=>true,
            'data_class' => 'Inamika\BackEndBundle\Entity\Customer'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return '';
    }


}
