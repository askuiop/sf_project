<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/11/5
 * Time: 14:18
 */

namespace Jims\PeteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UgroupType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('groupName');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jims\PeteBundle\Entity\Ugroup',
        ));
    }

    public function getName()
    {
        return 'ugroup';
    }

}