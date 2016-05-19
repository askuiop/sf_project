<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/5/15
 * Time: 16:47
 */

namespace Jims\StudyBundle\DataFixtures\ORM;


use Jims\StudyBundle\Entity\StUser;
use Nelmio\Alice\ProcessorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

class AppProcessor implements ProcessorInterface
{
  /**
   * @var UserPasswordEncoder
   */
  private $encoder;

  public function __construct(UserPasswordEncoder $encoder)
  {

    $this->encoder = $encoder;
  }

  public function preProcess($object)
  {
    if($object instanceof StUser) {
      $plainText = $object->getPlainPassword();
      $password = $this->encoder->encodePassword($object, $plainText);
      $object->setPassword($password);
    }
  }

  public function postProcess($object)
  {
    // TODO: Implement postProcess() method.
  }


}