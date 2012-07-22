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

class StoryManager extends BaseManager {

    public function getOrderedStoriesByBacklog($backlog) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['s','s.priority/s.difficulty AS realPriority'])
                ->from($this->class, 's')
                ->where('s.backlog = ?1')
                ->orderBy('realPriority','ASC');
        $query = $qb->getQuery();
        $query->setParameter(1, $backlog);

        return $query->getResult();
    }
    public function getOrderedStoriesBySandbox($sandbox) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['s','s.priority/s.difficulty AS realPriority'])
                ->from($this->class, 's')
                ->where('s.sandbox = ?1')
                ->orderBy('realPriority','ASC');
        $query = $qb->getQuery();
        $query->setParameter(1, $sandbox);

        return $query->getResult();
    }

}