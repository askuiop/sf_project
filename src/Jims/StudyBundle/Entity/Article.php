<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/4/24
 * Time: 17:02
 */

namespace Jims\StudyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Jims\StudyBundle\Entity\StUser;
use Jims\StudyBundle\Entity\Course;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="ArticleRepository")
 * @ORM\Table(name="article")
 * @ORM\HasLifecycleCallbacks()
 */
class Article
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   * @ORM\Column(type="integer")
   */
  private $id;
  /**
   * @Assert\NotBlank(message="plase enter a title!")
   * @ORM\Column(type="string")
   */
  private $title;
  /**
   * @ORM\Column(type="string")
   */
  private $content;
  /**
   * @ORM\Column(type="datetime")
   */
  private $createdAt;
  /**
   * @ORM\Column(type="datetime")
   */
  private $updatedAt;


  /**
   * @var StUser
   * @ORM\ManyToOne(targetEntity="Jims\StudyBundle\Entity\StUser", inversedBy="articles")
   */
  private $user;

  /**
   * @var
   * @ORM\ManyToMany(targetEntity="Jims\StudyBundle\Entity\Course", inversedBy="articles")
   */
  private $courses;





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
     * @param \Jims\StudyBundle\Entity\StUser $user
     *
     * @return Article
     */
    public function setUser(\Jims\StudyBundle\Entity\StUser $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Jims\StudyBundle\Entity\StUser
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->courses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add couse
     *
     * @param \Jims\StudyBundle\Entity\Course $couse
     *
     * @return Article
     */
    public function addCouse(\Jims\StudyBundle\Entity\Course $couse)
    {
        $this->courses[] = $couse;

        return $this;
    }

    /**
     * Remove couse
     *
     * @param \Jims\StudyBundle\Entity\Course $couse
     */
    public function removeCouse(\Jims\StudyBundle\Entity\Course $couse)
    {
        $this->courses->removeElement($couse);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getcourses()
    {
        return $this->courses;
    }


  /**
   * @ORM\PrePersist()
   */
    public function prePersist()
    {
      if (empty($this->createdAt)) {
        $this->setCreatedAt(new \DateTime());
      }

      if (empty($this->updatedAt)) {
        $this->setUpdatedAt(new \DateTime());
      }


    }

  /**
   * @ORM\PreUpdate()
   */
  public function preUpdate()
  {
    $this->setUpdatedAt(new \DateTime());
  }
}
