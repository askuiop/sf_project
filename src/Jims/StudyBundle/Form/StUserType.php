<?php

namespace Jims\StudyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email', 'email')
            ->add('plainPassword', 'repeated' , array(
                //'error_bubbling' => true,
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'type' => 'password',
                'first_options' => array('label' => 'password','error_bubbling' => false),
                'second_options' => array('label' => 'repeated password','error_bubbling' => false),


            ))
            ->add('sbmit', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jims\StudyBundle\Entity\StUser'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jims_studybundle_stuser';
    }
}
