<?php

namespace Jims\UiopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserLoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('acount', 'text' , array(
          ))
          ->add('password', 'password')
          //->setAction($this->)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jims\PeteBundle\Entity\User'
        ));

    }

    public function getName()
    {
        return 'jims_uiop_bundle_user_login_type';
    }
}
