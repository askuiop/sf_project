<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/5/15
 * Time: 14:46
 */

namespace Jims\StudyBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

class AppFeatures extends AbstractLoader
{
  /**
   * {@inheritdoc}
   */
  public function getFixtures()
  {
    return [
      __DIR__.'/Course.yml',
      __DIR__.'/StUser.yml',
      __DIR__.'/Article.yml',
      #'@DummyBundle/DataFixtures/ORM/product.yml',
    ];
  }

  public function dtObject()
  {
    return new \DateTime();
  }

  public function courseName()
  {
    $course = array(
      'PHP',
      'java',
      'c',
      'c#',
      'oc',
      'javacript',
      'python',
    );
    return $course[rand(0,6)];
  }






}