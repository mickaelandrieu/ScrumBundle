<?php

namespace NicoB\ScrumBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use NicoB\ScrumBundle\Entity\Type;

class LoadTypeData implements FixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        $names = array('nicob.scrum.type.task', 'nicob.scrum.type.buy', 'nicob.scrum.type.release', 'nicob.scrum.type.chore');
        foreach($names as $name) {
            $entity = new Type();
            $entity->setName($name);
            $manager->persist($entity);
        }
        
        $manager->flush();
    }

}
