<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/12/29
 * Time: 11:08
 */

namespace Jims\UiopBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UeditorType extends AbstractType
{
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(

    ));
  }

  public function getParent()
  {
    return 'text';
  }

  public function getName()
  {
    return 'ueditor';
  }
}