<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2015/10/31
 * Time: 16:22
 */
namespace Jims\PeteBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use Doctrine\ORM\EntityManager;

class WebserviceUserProvider implements UserProviderInterface
{
    private $em;
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    public function loadUserByUsername($username)
    {
        $userData = $this->em->getRepository("\Jims\PeteBundle\Entity\User")->findOneBy(array("account"=>$username));

        // pretend it returns an array on success, false if there is no user

        if ($userData) {
            $password = $userData->getPassword();
            $roles = $userData->getRoles();
            $salt = $userData->getSalt();
            $id = $userData->getId();

            return new WebserviceUser($username, $password, $salt, $roles , $id);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Jims\PeteBundle\Security\WebserviceUser';
    }
}