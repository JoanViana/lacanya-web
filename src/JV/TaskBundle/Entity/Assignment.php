<?php

namespace JV\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Assignment
 *
 * @ORM\Table(name="assignment")
 * @ORM\Entity(repositoryClass="JV\TaskBundle\Repository\AssignmentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Assignment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * 
     * @ORM\Column(name="Function", type="string", length=255, nullable=true)
     */
    private $function;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean")
     * @Assert\NotBlank(message="as.nb")
     */
    private $isActive;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set function
     *
     * @param string $function
     *
     * @return Assignment
     */
    public function setFunction($function)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }
    
    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Task
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Assignment
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
     * @return Task
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
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="assignments")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(message="as.nb")
     */
    protected $project;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="assignments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(message="as.nb")
     */
    protected $user;
   

    /**
     * Set project
     *
     * @param \JV\TaskBundle\Entity\Project $project
     *
     * @return Assignment
     */
    public function setProject(\JV\TaskBundle\Entity\Project $project)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \JV\TaskBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set user
     *
     * @param \JV\TaskBundle\Entity\User $user
     *
     * @return Assignment
     */
    public function setUser(\JV\TaskBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \JV\TaskBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
