<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/11/1
 * Time: 16:51
 */
namespace Jims\PeteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jims\PeteBundle\Entity\Category',
        ));
    }

    public function getName()
    {
        return 'category';
    }
}