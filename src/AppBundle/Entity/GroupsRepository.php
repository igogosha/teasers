<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * GroupsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GroupsRepository extends EntityRepository
{
    public function byUserIndexedByGroupIds(User $user)
    {
        $q = $this->getEntityManager()
            ->createQuery("SELECT g FROM AppBundle:Groups g LEFT JOIN g.user u INDEX BY g.id WHERE g.user = :user");

        $q->setParameter('user', $user);

        return $q->getResult();
    }
}
