<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/4/18
 * Time: 13:03
 */

namespace Jims\StudyBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Jims\StudyBundle\Entity\StUser;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadStUser implements FixtureInterface, ContainerAwareInterface
{
  /**
   * @var ContainerInterface;
   */
  private $container;

  public function setContainer(ContainerInterface $container = null)
  {
    $this->container = $container;
  }

  public function load(ObjectManager $manager)
  {
    $user1 = new StUser();
    $user1->setUserName('test1');
    $user1->setEmail('test@test.com');
    $user1->setIsAvaildable(1);
    $user1->setPassword($this->encodePassword($user1, 'test'));
    $user1->setRoles(array("ROLE_USER"));
    $user1->setCreatedAt(new \DateTime());
    $user1->setUpdatedAt(new \DateTime());
    $manager->persist($user1);

    $user2 = new StUser();
    $user2->setUserName('test2');
    $user2->setEmail('test@test.com');
    $user2->setIsAvaildable(1);
    $user2->setPassword($this->encodePassword($user1, 'test'));
    $user2->setRoles(array("ROLE_ADMIN"));
    $user2->setCreatedAt(new \DateTime());
    $user2->setUpdatedAt(new \DateTime());
    $manager->persist($user2);

    $manager->flush();
    
  }

  private function encodePassword(StUser $user, $plainPassword)
  {
    $encoder = $this->container->get('security.password_encoder');
    return $encoder->encodePassword($user, $plainPassword);

  }

  

}