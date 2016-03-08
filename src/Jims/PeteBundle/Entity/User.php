<?php
namespace Jims\PeteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class User
 * @package JimsPeteBundle\Entity
 * @ORM\Entity(repositoryClass="UserRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="user")
 * @ORM\Table(options={"collate"="utf8mb4_unicode_ci", "charset"="utf8mb4"})
 *
 */
class User implements UserInterface, \Serializable
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
     * @Assert\Length(min=6,max=20)
     *
     */
    protected $username;
    /**
     * @var
     * @ORM\Column(type="string",length=100)
     * @Assert\Length(min=6,max=20)
     */
    protected $account;
    /**
     * @var
     * @ORM\Column(type="string",length=100)
     * @Assert\Length(min=6,max=20)
     */
    protected $password;
    /**
     * @var
     * @ORM\Column(type="boolean",options={"default"=0})
     *
     */
    protected $isAvailable;

    /**
     * @var
     * @ORM\Column(type="string",length=255)
     */
    protected $path;

    /**
     * @var
     * @ORM\Column(type="string",length=255)
     */
    protected $avatar;

    /**
     * @var
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    protected $createdAt;
    /**
     * @var
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    protected $UpdatedAt;


    /**
     * @Assert\Type(type="Jims\PeteBundle\Entity\Category")
     * @Assert\Valid()
     */
    protected $category;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;


    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Ugroup", inversedBy="users")
     * @ORM\JoinTable(name="users_ugroups")
     */
    private $ugroups;

    /**
     * @ORM\OneToOne(targetEntity="Profile", mappedBy="user")
     *
     */
    private $profile;

    public function __construct(){
        $this->ugroups = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->profile = new \Doctrine\Common\Collections\ArrayCollection();

        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set account
     *
     * @param string $account
     *
     * @return User
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }



    /**
     * Set isAvailable
     *
     * @param integer $isAvailable
     *
     * @return User
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
     * @return User
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
     * Set UpdatedAt
     *
     * @param \DateTime $UpdatedAt
     *
     * @return User
     */
    public function setUpdatedAt($UpdatedAt)
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    /**
     * Get UpdatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->UpdatedAt;
    }

    /**
     * Set profile
     *
     * @param \Jims\PeteBundle\Entity\Profile $profile
     *
     * @return User
     */
    public function setProfile(\Jims\PeteBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Jims\PeteBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Add ugroup
     *
     * @param \Jims\PeteBundle\Entity\Ugroup $ugroup
     *
     * @return User
     */
    public function addUgroup(\Jims\PeteBundle\Entity\Ugroup $ugroup)
    {
        $this->ugroups[] = $ugroup;

        return $this;
    }

    /**
     * Remove ugroup
     *
     * @param \Jims\PeteBundle\Entity\Ugroup $ugroup
     */
    public function removeUgroup(\Jims\PeteBundle\Entity\Ugroup $ugroup)
    {
        $this->ugroups->removeElement($ugroup);
    }

    /**
     * Get ugroups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUgroups()
    {
        return $this->ugroups;
    }



    public function getPassword()
    {
        return $this->password;
    }


    public function getRoles()
    {
        return array('ROLE_ADMIN', 'ROLE_SONATA_ADMIN');
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
     * Removes sensitive data from the user.
     */
    public function eraseCredentials()
    {
        // if you had a plainPassword property, you'd nullify it here
        // $this->plainPassword = null;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->userName,
            $this->psw,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->userName,
            $this->psw,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }


    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }


    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(Category $category = null)
    {
        $this->category = $category;
    }




    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return User
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set accounting
     *
     * @param string $accounting
     *
     * @return User
     */
    public function setAccounting($accounting)
    {
        $this->accounting = $accounting;

        return $this;
    }

    /**
     * Get accounting
     *
     * @return string
     */
    public function getAccounting()
    {
        return $this->accounting;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        dump(1);
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        dump(2);
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        //当移动文件发生错误，一个异常move（）会自动抛出异常。
        //这将阻止实体持久化数据库发生错误。
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/user';
    }
}
