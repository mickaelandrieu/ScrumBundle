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

        $names = array('truc', 'truc', 'truc', 'truc');
        foreach($names as $name) {
            $entity = new Type();
            $entity->setName($name);
            $manager->persist($entity);
        }
        
        $manager->flush();
    }

}