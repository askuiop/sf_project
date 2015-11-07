<?php
namespace Jims\PeteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Profile
 * @package JimsPeteBundle\Entity
 * @ORM\Entity(repositoryClass="ProfileRepository")
 * @ORM\Table(name="profile")
 * @ORM\Table(options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 */
class Profile
{
    /**
     * @var
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var
     * @ORM\Column(type="string",length=100)
     *
     */
    protected $realName;
    /**
     * @var
     * @ORM\Column(type="integer",length=20)
     *
     */
    protected $tel;
    /**
     * @var
     * @ORM\Column(type="string",length=200)
     *
     */
    protected $adress;
    /**
     * @var
     * @ORM\Column(type="boolean",options={"default"=0})
     */
    protected $isAvailable;
    /**
     * @var
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    /**
     * @var
     * @ORM\Column(type="datetime")
     */
    protected $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="profile")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function __construct()
    {
        //$this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set realName
     *
     * @param string $realName
     *
     * @return Profile
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;

        return $this;
    }

    /**
     * Get realName
     *
     * @return string
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * Set tel
     *
     * @param integer $tel
     *
     * @return Profile
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return integer
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set adress
     *
     * @param string $adress
     *
     * @return Profile
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set isAvailable
     *
     * @param integer $isAvailable
     *
     * @return Profile
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * Get isAvailable
     *
     * @return integer
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Profile
     */
    public function setcreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getcreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Profile
     */
    public function setupdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getupdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set user
     *
     * @param \Jims\PeteBundle\Entity\User $user
     *
     * @return Profile
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
}
