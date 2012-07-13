<?php

namespace NicoB\ScrumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;

/*
 * This file is part of the NicoBScrumBundle package.
 *
 * (c) Nicolas Badey
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolas Badey <nicolas.badey@gmail.com>
 */

/**
 * NicoB\ScrumBundle\Entity\Scrum
 *
 * @ORM\Table(name="story")
 * @ORM\Entity
 */
class Story {

    /**
     * @var integer $id
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    protected $id;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var string $name
     *
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @var string $description
     *
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Sandbox", inversedBy="stories")
     * */
    private $sandbox;

    /**
     * @ORM\ManyToOne(targetEntity="Backlog", inversedBy="stories")
     * */
    private $backlog;

    /**
     * @ORM\OneToOne(targetEntity="Status")
     * */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="Type")
     * */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity="Priority")
     * */
    private $priority;

    /**
     * @ORM\OneToOne(targetEntity="Difficulty")
     * */
    private $difficulty;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * 
     */
    protected $createdBy;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * 
     */
    protected $assignedAt;
    

    public function __construct() {
        $this->createdAt = new \DateTime;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return Story
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Story
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return Story
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set sandbox
     *
     * @param NicoB\ScrumBundle\Entity\Sandbox $sandbox
     * @return Story
     */
    public function setSandbox(\NicoB\ScrumBundle\Entity\Sandbox $sandbox = null) {
        $this->sandbox = $sandbox;
        return $this;
    }

    /**
     * Get sandbox
     *
     * @return NicoB\ScrumBundle\Entity\Sandbox 
     */
    public function getSandbox() {
        return $this->sandbox;
    }

    /**
     * Set backlog
     *
     * @param NicoB\ScrumBundle\Entity\Backlog $backlog
     * @return Story
     */
    public function setBacklog(\NicoB\ScrumBundle\Entity\Backlog $backlog = null) {
        $this->backlog = $backlog;
        return $this;
    }

    /**
     * Get backlog
     *
     * @return NicoB\ScrumBundle\Entity\Backlog 
     */
    public function getBacklog() {
        return $this->backlog;
    }

    /**
     * Set status
     *
     * @param NicoB\ScrumBundle\Entity\status $status
     * @return Story
     */
    public function setStatus(\NicoB\ScrumBundle\Entity\status $status = null) {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return NicoB\ScrumBundle\Entity\status 
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set type
     *
     * @param NicoB\ScrumBundle\Entity\type $type
     * @return Story
     */
    public function setType(\NicoB\ScrumBundle\Entity\type $type = null) {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return NicoB\ScrumBundle\Entity\type 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set priority
     *
     * @param NicoB\ScrumBundle\Entity\Priority $priority
     * @return Story
     */
    public function setPriority(\NicoB\ScrumBundle\Entity\Priority $priority = null) {
        $this->priority = $priority;
        return $this;
    }

    /**
     * Get priority
     *
     * @return NicoB\ScrumBundle\Entity\Priority 
     */
    public function getPriority() {
        return $this->priority;
    }

    /**
     * Set difficulty
     *
     * @param NicoB\ScrumBundle\Entity\Difficulty $difficulty
     * @return Story
     */
    public function setDifficulty(\NicoB\ScrumBundle\Entity\Difficulty $difficulty = null) {
        $this->difficulty = $difficulty;
        return $this;
    }

    /**
     * Get difficulty
     *
     * @return NicoB\ScrumBundle\Entity\Difficulty 
     */
    public function getDifficulty() {
        return $this->difficulty;
    }


    /**
     * Set createdBy
     *
     * @param NicoB\ScrumBundle\Entity\User $createdBy
     * @return Story
     */
    public function setCreatedBy(\NicoB\ScrumBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * Get createdBy
     *
     * @return NicoB\ScrumBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set assignedAt
     *
     * @param NicoB\ScrumBundle\Entity\User $assignedAt
     * @return Story
     */
    public function setAssignedAt(\NicoB\ScrumBundle\Entity\User $assignedAt = null)
    {
        $this->assignedAt = $assignedAt;
        return $this;
    }

    /**
     * Get assignedAt
     *
     * @return NicoB\ScrumBundle\Entity\User 
     */
    public function getAssignedAt()
    {
        return $this->assignedAt;
    }
}