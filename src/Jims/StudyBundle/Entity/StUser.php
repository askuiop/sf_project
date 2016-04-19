<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/4/17
 * Time: 16:45
 */

namespace Jims\StudyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity(repositoryClass="StUserRepository")
 * @ORM\Table(name="st_user")
 *
 */
class StUser implements AdvancedUserInterface
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getPlainPassword()
  {
    return $this->plainPassword;
  }

  /**
   * @param mixed $plainPassword
   */
  public function setPlainPassword($plainPassword)
  {
    $this->plainPassword = $plainPassword;
  }

  /**
   * @ORM\Column(type="string")
   */
  private $userName;

  /**
   * @ORM\Column(type="string")
   */
  private $email;

  /**
   * @ORM\Column(type="string")
   */
  private $password;

  /**
   * @ORM\Column(type="boolean")
   */
  private $is_availdable;

  /**
   * @var array
   *
   * @ORM\Column(type="json_array")
   */
  private $roles;


  /**
   * @ORM\Column(type="datetime")
   */
  private $createdAt;

  /**
   * @ORM\Column(type="datetime")
   */
  private $updatedAt;


  private $plainPassword;


    /**
     * Set userName
     *
     * @param string $userName
     *
     * @return StUser
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return StUser
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return StUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set isAvaildable
     *
     * @param boolean $isAvaildable
     *
     * @return StUser
     */
    public function setIsAvaildable($isAvaildable)
    {
        $this->is_availdable = $isAvaildable;

        return $this;
    }

    /**
     * Get isAvaildable
     *
     * @return boolean
     */
    public function getIsAvaildable()
    {
        return $this->is_availdable;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return StUser
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return StUser
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
        return $this;
    }

    public function getRoles()
    {
      $roles = $this->roles;
      $roles[] = 'ROLE_USER';  //默认给所有用户增加一个Role
      return array_unique($roles);
    }

    public function getSalt()
    {
      return null;
    }

    public function eraseCredentials()
    {
      // TODO: Implement eraseCredentials() method.
    }



    public function isAccountNonExpired()
    {
      return true;
    }

    public function isAccountNonLocked()
    {
      return true;
    }

    public function isCredentialsNonExpired()
    {
      return true;
    }

    public function isEnabled()
    {
      return true;
    }




}
