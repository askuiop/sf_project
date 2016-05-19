<?php
/**
 * Created by PhpStorm.
 * User: jimspete
 * Date: 2016/4/24
 * Time: 16:51
 */

namespace Jims\StudyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Jims\StudyBundle\Entity\Article;


/**
 * @ORM\Entity(repositoryClass="CourseRepository")
 * @ORM\Table(name="course")
 */
class Course
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
   * @var
   * @ORM\ManyToMany(targetEntity="Jims\StudyBundle\Entity\Article", mappedBy="courses")
   * @ORM\JoinTable(name="courses_articles")
   */
  private $articles;

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
  public function getupdatedAt()
  {
    return $this->updatedAt;
  }

  /**
   * @param mixed $updatedAt
   */
  public function setupdatedAt($updatedAt)
  {
    $this->updatedAt = $updatedAt;
  }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add article
     *
     * @param \Jims\StudyBundle\Entity\Article $article
     *
     * @return Course
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


  public function hasArticles(Article $article)
  {
    return $this->getArticles()->contains($article);
  }
}
