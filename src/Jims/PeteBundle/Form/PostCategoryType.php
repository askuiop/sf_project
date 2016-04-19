<?php

namespace Jims\PeteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('posts', 'entity', array(
                'class' => 'Jims\PeteBundle\Entity\Post',
                'choice_label' => 'title',
                'expanded' => true,
                'multiple' => true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jims\PeteBundle\Entity\PostCategory'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jims_petebundle_postcategory';
    }
}
