<?php

namespace NicoB\ScrumBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use NicoB\ScrumBundle\Entity\Priority;

class LoadPriorityData implements FixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        $names = range(1,5);
        foreach($names as $name) {
            $entity = new Priority();
            $entity->setName($name);
            $manager->persist($entity);
        }
        
        $manager->flush();
    }

}
