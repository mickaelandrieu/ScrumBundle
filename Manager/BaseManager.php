<?php

namespace NicoB\ScrumBundle\Manager;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

abstract class BaseManager {

    
    protected $em;
    protected $class;
    protected $repository;

    public function __construct($em, $class) {
        $this->em = $em;
        $this->repository = $em->getRepository($class);

        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
    }

    /**
     * {@inheritDoc}
     */
    public function getClass() {
        return $this->class;
    }

    public function create() {
        $class = $this->getClass();
        return new $class;
    }

    public function update($entity, $andFlush = true) {
        $this->em->persist($entity);
        if ($andFlush) {
            $this->em->flush();
        }
    }

    public function delete($entity, $andFlush = true) {
        $this->em->remove($entity);
        if ($andFlush) {
            $this->em->flush();
        }
    }
    
    public function findOneBy(array $criteria,$exception = false)
    {
        $entity = $this->repository->findOneBy($criteria);
        if ($exception && !$entity) {
            throw new NotFoundHttpException('Unable to find entity.');
        }
        return $entity;
    }
    
    public function findBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
    
    public function find($id,$exception = false)
    {
        $entity = $this->repository->find($id);
        if ($exception && !$entity) {
            throw new NotFoundHttpException('Unable to find entity.');
        }
        return $entity;
    }
    
    public function findAll()
    {
        return $this->repository->findAll();
    }

}