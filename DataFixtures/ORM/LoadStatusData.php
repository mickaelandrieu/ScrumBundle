<?php

namespace NicoB\ScrumBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use NicoB\ScrumBundle\Entity\Status;

class LoadStatusData implements FixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        $names = array(
            'nicob.scrum.status.started', 
            'nicob.scrum.status.finished', 
            'nicob.scrum.status.delivered', 
            'nicob.scrum.status.accepted',
            'nicob.scrum.status.rejected'
        );
        foreach($names as $name) {
            $entity = new Status();
            $entity->setName($name);
            $manager->persist($entity);
        }
        
        $manager->flush();
    }

}
