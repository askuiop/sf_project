<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/3/20
 * Time: 10:29
 */

namespace Jims\PeteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="GBookRepository")
 * @ORM\Table(name="gbook")
 * @ORM\HasLifecycleCallbacks()
 */
class GBook
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string")
   */
  private $title;

  /**
   * @ORM\Column(type="string")
   */
  private $content;

  /**
   * @ORM\ManyToOne(targetEntity="Jims\PeteBundle\Entity\User")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
  private $user;

  /**
   * @ORM\ManyToOne(targetEntity="Jims\PeteBundle\Entity\Post")
   * @ORM\JoinColumn(
   *   name="post_id",
   *   referencedColumnName="id",
   * )
   */
  private $post;

  /**
   * @ORM\Column(type="string")
   */
  private $name;

  /**
   * @ORM\Column(type="datetime")
   */
  private $createdAt;

  /**
   * @ORM\Column(type="datetime")
   */
  private $updatedAt;

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
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * @param mixed $title
   */
  public function setTitle($title)
  {
    $this->title = $title;
  }

  /**
   * @return mixed
   */
  public function getContent()
  {
    return $this->content;
  }

  /**
   * @param mixed $content
   */
  public function setContent($content)
  {
    $this->content = $content;
  }



  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * @return mixed
   */
  public function getCreatedAt()
  {
    return $this->createdAt;
  }

  /**
   * @param mixed $createdAt
   */
  public function setCreatedAt($createdAt)
  {
    $this->createdAt = $createdAt;
  }

  /**
   * @return mixed
   */
  public function getUpdatedAt()
  {
    return $this->updatedAt;
  }

  /**
   * @param mixed $updatedAt
   */
  public function setUpdatedAt($updatedAt)
  {
    $this->updatedAt = $updatedAt;
  }


    /**
     * Set user
     *
     * @param \Jims\PeteBundle\Entity\User $user
     *
     * @return GBook
     */
    public function setUser(\Jims\PeteBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Jims\PeteBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @ORM\PrePersist()
     */
    public function timeHandler()
    {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTime();
            $this->updatedAt = $this->createdAt;
        }
    }



    /**
     * Set post
     *
     * @param \Jims\PeteBundle\Entity\Post $post
     *
     * @return GBook
     */
    public function setPost(\Jims\PeteBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Jims\PeteBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }
}
