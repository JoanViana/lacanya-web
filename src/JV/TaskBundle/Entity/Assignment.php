<?php

namespace JV\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JV\TaskBundle\Entity\User;
use JV\TaskBundle\Entity\Project;

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
     * @ORM\Column(name="Active", type="boolean")
     * @Assert\NotBlank(message="as.nb")
     */
    private $isActive;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="AddedAt", type="datetime")
     */
    private $addedAt;


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
     * Set addedAt
     *
     * @param \DateTime $addedAt
     *
     * @return Assignment
     */
    public function setAddedAt($addedAt)
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    /**
     * Get addedAt
     *
     * @return \DateTime
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function setAddedAtValue()
    {
        $this->AddedAt = new \DateTime();
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
