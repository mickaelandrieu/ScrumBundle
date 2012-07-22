<?php

namespace NicoB\ScrumBundle\Manager;

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

class BacklogManager extends BaseManager {
    
   public function getCurrent($project){
       $qb=$this->em->createQueryBuilder();
       $qb->select('b')
            ->from($this->class, 'b')
            ->where('b = ?1');
       $query = $qb->getQuery();
       $query->setParameter(1,$project);
       
       return $query->getOneOrNullResult();
   }
   
}