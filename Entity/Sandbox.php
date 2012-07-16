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
 * @ORM\Table(name="sandbox")
 * @ORM\Entity
 */
class Sandbox {

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
     * @ORM\OneToOne(targetEntity="Project", inversedBy="sandbox")
     * */
    private $project;

    /**
     * @ORM\OneToMany(targetEntity="Story", mappedBy="sandbox")
     * 
     */
    private $stories;

    public function __construct() {
        $this->stories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set project
     *
     * @param NicoB\ScrumBundle\Entity\Project $project
     * @return Sandbox
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

    /**
     * Add stories
     *
     * @param NicoB\ScrumBundle\Entity\Story $stories
     * @return Sandbox
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
        return 'do not instanced';
    }

}