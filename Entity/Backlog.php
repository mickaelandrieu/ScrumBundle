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
 * @ORM\Table(name="backlog")
 * @ORM\Entity
 */
class Backlog {

    /**
     * @var integer $id
     *
     * @ORM\Column(type="integer")
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
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="backlogs")
     * */
    protected $project;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="start_at", type="datetime")
     */
    protected $startAt;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="finish_at", type="datetime")
     */
    protected $finishAt;

    /**
     * @ORM\OneToMany(targetEntity="Story", mappedBy="backlog",cascade={"remove"})
     * 
     */
    private $stories;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Backlog
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
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return Backlog
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
     * Set startAt
     *
     * @param datetime $startAt
     * @return Backlog
     */
    public function setStartAt($startAt) {
        $this->startAt = $startAt;
        return $this;
    }

    /**
     * Get startAt
     *
     * @return datetime 
     */
    public function getStartAt() {
        return $this->startAt;
    }

    /**
     * Set finishAt
     *
     * @param datetime $finishAt
     * @return Backlog
     */
    public function setFinishAt($finishAt) {
        $this->finishAt = $finishAt;
        return $this;
    }

    /**
     * Get finishAt
     *
     * @return datetime 
     */
    public function getFinishAt() {
        return $this->finishAt;
    }

    /**
     * Set project
     *
     * @param NicoB\ScrumBundle\Entity\Project $project
     * @return Backlog
     */
    public function setProject(\NicoB\ScrumBundle\Entity\Project $project = null) {
        $this->project = $project;
        return $this;
    }

    /**
     * Get project
     *
     * @return NicoB\ScrumBundle\Entity\Project 
     */
    public function getProject() {
        return $this->project;
    }

    public function __construct() {
        $this->stories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = new \DateTime;
    }

    /**
     * Add stories
     *
     * @param NicoB\ScrumBundle\Entity\Story $stories
     * @return Backlog
     */
    public function addStorie(\NicoB\ScrumBundle\Entity\Story $stories) {
        $this->stories[] = $stories;
        return $this;
    }

    /**
     * Remove stories
     *
     * @param <variableType$stories
     */
    public function removeStorie(\NicoB\ScrumBundle\Entity\Story $stories) {
        $this->stories->removeElement($stories);
    }

    /**
     * Get stories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getStories() {
        return $this->stories;
    }

    public function __toString() {
        return $this->name;
    }

}