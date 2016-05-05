<?php

namespace Jims\StudyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UpdateArticleType extends ArticleType
{

    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'is_edit' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jims_studybundle_update_article';
    }
}
