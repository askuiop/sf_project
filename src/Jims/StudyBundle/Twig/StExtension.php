<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/4/25
 * Time: 13:10
 */

namespace Jims\StudyBundle\Twig;


class StExtension extends \Twig_Extension
{
  public function getName()
  {
    return 'study';
  }

  public function getFilters()
  {
    return array(
      new \Twig_SimpleFilter('ago', array($this, 'myAgo'))
    );
  }

  public function myAgo($agr)
  {
    return $agr.'xxxx';
  }


}