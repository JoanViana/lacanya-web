<?php

namespace JV\TaskBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="JV\TaskBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */

class User extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
        $this->roles = array('ROLE_USER');
    	$this->assignments = new ArrayCollection();
        $this->tasks = new ArrayCollection();

    }
    
    /**
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=100)
     * @Assert\NotBlank(message="as.nb")
     */
    private $firstName;


    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100)
     * @Assert\NotBlank(message="as.nb")
     */
    private $lastName;

    /**
     * @var string
     * 
     * @Assert\NotBlank(message="as.nb")
     * @ORM\Column(name="phone", type="integer")
     * @Assert\Regex("/\d{9,12}/")
     */
    private $phone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreatedAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="UpdatedAt", type="datetime")
     */
    private $updatedAt;

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
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

     /**
     * Set phone
     *
     * @param integer $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
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
     * @return User
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
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Assignment", mappedBy="user", cascade={"persist","remove"})
     * @Assert\NotBlank(message="as.nb")
     */
    protected $assignments;
    
    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="user", cascade={"persist","remove"})
     * @Assert\NotBlank(message="as.nb")
     */
    protected $tasks;
    
    /**
     * Add assignment
     *
     * @param \JV\TaskBundle\Entity\Assignment $assignment
     *
     * @return User
     */
    public function addAssignment(\JV\TaskBundle\Entity\Assignment $assignment)
    {
        $this->assignments[] = $assignment;

        return $this;
    }

    /**
     * Remove assignment
     *
     * @param \JV\TaskBundle\Entity\Assignment $assignment
     */
    public function removeAssignment(\JV\TaskBundle\Entity\Assignment $assignment)
    {
        $this->assignments->removeElement($assignment);
    }

    /**
     * Get assignments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssignments()
    {
        return $this->assignments;
    }

    /**
     * Add task
     *
     * @param \JV\TaskBundle\Entity\Task $task
     *
     * @return User
     */
    public function addTask(\JV\TaskBundle\Entity\Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \JV\TaskBundle\Entity\Task $task
     */
    public function removeTask(\JV\TaskBundle\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
