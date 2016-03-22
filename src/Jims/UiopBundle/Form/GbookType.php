<?php

namespace Jims\UiopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GbookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
                'label' => '标题：',
             ))
            ->add('content', 'textarea', array(
                'label' => '内容：',
            ))
            //->add('user', 'entity', array(
            //    'class' => 'Jims\PeteBundle\Entity\User',
            //    'choice_label' => 'username',
            //    'multiple' => false,
            //    'expanded' => true,
            //))
            //->add('createdAt', 'datetime', array(
            //    'widget' => 'single_text'
            //));
            //->add('createdAt', 'datetime')
            //->add('updatedAt', 'datetime')
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jims\PeteBundle\Entity\GBook',
        ));

    }

    public function getName()
    {
        return 'jims_uiop_bundle_gbook_type';
    }
}
