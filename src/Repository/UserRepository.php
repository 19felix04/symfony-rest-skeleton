<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    /**
     * The function returns user entity with passing username. If no user is found null will be returned.
     *
     * @param string $username
     * @return null|\Symfony\Component\Security\Core\User\UserInterface
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadUserByUsername($username)
    {
        $qb = $this->createQueryBuilder("user");
        $qb->where($qb->expr()->orX(
            $qb->expr()->eq("user.username", ":username"),
            $qb->expr()->eq("user.email", ":username")
        ));
        $qb->setParameter("username", $username);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
