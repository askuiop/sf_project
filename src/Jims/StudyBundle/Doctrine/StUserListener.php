<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/4/24
 * Time: 15:23
 */

namespace Jims\StudyBundle\Doctrine;


use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Jims\StudyBundle\Entity\StUser;

class StUserListener
{
  /**
   * @var UserPasswordEncoder
   */
  private $encoder;

  public function __construct(UserPasswordEncoder $encoder)
  {
    $this->encoder = $encoder;
  }

  public function prePersist(LifecycleEventArgs $args)
  {

    $entity = $args->getEntity();

    if ( $entity instanceof StUser ) {
      $this->encodePassword($entity);
    }
  }


  private function encodePassword(StUser $user)
  {
    $plainPassword = $user->getPlainPassword();
    $password =  $this->encoder->encodePassword($user, $plainPassword);

    $user->setPassword($password);

  }

}