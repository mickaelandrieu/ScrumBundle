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
 * @ORM\Table(name="difficulty")
 * @ORM\Entity
 */
class Difficulty {

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
     * @var string $name
     *
     * @ORM\Column(type="integer", length=1)
     */
    protected $name;

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
     * @return Difficulty
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

    public function __toString() {
        return (string)$this->name;
    }

}