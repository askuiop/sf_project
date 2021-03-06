<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/4/17
 * Time: 16:45
 */

namespace Jims\StudyBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Jims\StudyBundle\Entity\Article;

/**
 * @ORM\Entity(repositoryClass="StUserRepository")
 * @ORM\Table(name="st_user")
 * @ORM\HasLifecycleCallbacks()
 *
 */
class StUser implements AdvancedUserInterface , \Serializable
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
   * @ORM\Column(type="string")
   * @Assert\Length(min=6,max=20)
   */
  private $username;

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
   * @var Article
   * @ORM\OneToMany(targetEntity="Jims\StudyBundle\Entity\Article", mappedBy="user")
   */
  private $articles;


  public function __construct()
  {
    $this->articles = new ArrayCollection();
  }


    /**
     * Set username
     *
     * @param string $username
     *
     * @return StUser
     */
    public function setusername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getusername()
    {
        return $this->username;
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

  ////////////////////////////////////////////////////////////

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

    public function serialize()
    {
      return serialize(array(
        $this->id,
        $this->username,
        $this->password,
      ));
    }

    public function unserialize($serialized)
    {
      return list(
        $this->id,
        $this->username,
        $this->password,
        ) = unserialize($serialized);
    }

  /**
   * @ORM\PrePersist()
   */
    public function prepersist()
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTime();
        }
        if (!$this->updatedAt) {
            $this->updatedAt = $this->createdAt;
        }
        if ($this->is_availdable == null) {
          $this->is_availdable = true;
        }

    }

  /**
   * @ORM\PreUpdate()
   */
    public function preUpdate()
    {
        $this->updatedAt =  new \DateTime();
    }



    /**
     * Add article
     *
     * @param \Jims\StudyBundle\Entity\Article $article
     *
     * @return StUser
     */
    public function addArticle(\Jims\StudyBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \Jims\StudyBundle\Entity\Article $article
     */
    public function removeArticle(\Jims\StudyBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
