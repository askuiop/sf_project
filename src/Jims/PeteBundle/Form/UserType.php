<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/11/1
 * Time: 16:06
 */
namespace Jims\PeteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('account')
            ->add('username', null)
            ->add('password', 'password')
            ->add('dueDate', 'datetime', array('mapped' => false))
            ->add('category', 'entity', array(
                'class' => 'JimsPeteBundle:Category',
                'choice_label' => 'name',
                'expanded'=> true,
                'multiple'=> false,
            ))

            ->add('ugroups', 'entity', array(
                'class' => 'JimsPeteBundle:Ugroup',
                'choice_label' => 'groupName',
                'multiple' => true,
                'expanded' => true,
            ))
            //->add('Ugroup', 'collection', array('type' => new UgroupType()))
            ->add("file")
            ->add('save', 'submit')
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jims\PeteBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'User';
    }
}