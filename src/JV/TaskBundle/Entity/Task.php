<?php

namespace JV\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="JV\TaskBundle\Repository\TaskRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Task
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
     * @ORM\Column(name="Name", type="string", length=255)
     * @Assert\NotBlank(message="as.nb")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Summary", type="string", length=1500)
     * @Assert\NotBlank(message="as.nb")
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="Link", type="string", length=255, nullable=true)
     * @Assert\Url(message="as.url")
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="Status", type="string", length=255)
     * @Assert\NotBlank(message="as.nb")
     * @Assert\Choice(choices = { "PROPOSED","WORKING","ACTIVE","FINISHED","CHECKED","CANCELLED"})
     */
    private $status;
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="StartDate", type="datetime")
     * @Assert\Date(message = "as.date")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EndDate", type="datetime", nullable=true)
     * @Assert\Date(message = "as.date")
     */
    private $endDate;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="Checked", type="boolean", nullable=true)
     */
    private $checked;
    
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
     * @var bool
     *
     * @ORM\Column(name="Enabled", type="boolean", nullable=true)
     * @Assert\NotBlank(message="as.nb")
     */
    private $enabled;


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
     * Set name
     *
     * @param string $name
     *
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return Task
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Task
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Task
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
 /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Task
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Task
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Task
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Task
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    
    /**
     * Set checked
     *
     * @param boolean $checked
     *
     * @return Task
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;

        return $this;
    }

    /**
     * Get checked
     *
     * @return bool
     */
    public function getChecked()
    {
        return $this->checked;
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
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="tasks", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(message="as.nb")
     */
    protected $project;
    
    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="tasks", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(message="as.nb")
     */
    protected $type;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tasks", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(message="as.nb")
     */
    protected $user;

    /**
     * Set project
     *
     * @param \JV\TaskBundle\Entity\Project $project
     *
     * @return Task
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
     * Set type
     *
     * @param \JV\TaskBundle\Entity\Type $type
     *
     * @return Task
     */
    public function setType(\JV\TaskBundle\Entity\Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \JV\TaskBundle\Entity\Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user
     *
     * @param \JV\TaskBundle\Entity\User $user
     *
     * @return Task
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
