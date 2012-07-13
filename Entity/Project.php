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
 * @ORM\Table(name="project")
 * @ORM\Entity
 */

class Project {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Backlog", mappedBy="project",cascade={"remove"})
     * 
     */
    protected $backlogs;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * 
     */
    protected $createdBy;
    
    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\OneToOne(targetEntity="Sandbox", mappedBy="project",cascade={"persist"})
     **/
    protected $sandbox;
    
    public function __construct(){
        $this->createdAt = new \DateTime;
        $this->backlog = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Project
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
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return Project
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Add backlog
     *
     * @param NicoB\ScrumBundle\Entity\Backlog $backlog
     * @return Project
     */
    public function addBacklog(\NicoB\ScrumBundle\Entity\Backlog $backlog)
    {
        $this->backlog[] = $backlog;
        return $this;
    }

    /**
     * Remove backlog
     *
     * @param <variableType$backlog
     */
    public function removeBacklog(\NicoB\ScrumBundle\Entity\Backlog $backlog)
    {
        $this->backlog->removeElement($backlog);
    }

    /**
     * Get backlog
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBacklog()
    {
        return $this->backlog;
    }

    /**
     * Get backlogs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBacklogs()
    {
        return $this->backlogs;
    }

    /**
     * Set sandbox
     *
     * @param NicoB\ScrumBundle\Entity\Sandbox $sandbox
     * @return Project
     */
    public function setSandbox(\NicoB\ScrumBundle\Entity\Sandbox $sandbox = null)
    {
        $this->sandbox = $sandbox;
        return $this;
    }

    /**
     * Get sandbox
     *
     * @return NicoB\ScrumBundle\Entity\Sandbox 
     */
    public function getSandbox()
    {
        return $this->sandbox;
    }
    
    public function __toString(){
        return $this->name;
    }

    /**
     * Set createdBy
     *
     * @param NicoB\ScrumBundle\Entity\User $createdBy
     * @return Project
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
}