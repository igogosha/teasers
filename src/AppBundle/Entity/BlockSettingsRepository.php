<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

use AppBundle\Entity\User;

/**
 * BlockSettingsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlockSettingsRepository extends EntityRepository
{
    public function getStatsForUser(User $user)
    {
        $q = $this->getEntityManager()
            ->createQuery('SELECT b.id FROM AppBundle:BlockSettings b INDEX BY b.id WHERE b.user = ' . $user->getId());

        return $q->getArrayResult();
    }

    public function countForUser(User $user)
    {
        $q = $this->createQueryBuilder('t')
            ->select('COUNT(t)')
            ->where('t.user = :user')
            ->setParameter('user', $user);

        return $q->getQuery()->getSingleScalarResult();
    }
}
