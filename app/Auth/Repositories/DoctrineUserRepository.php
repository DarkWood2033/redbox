<?php

namespace App\Auth\Repositories;

use App\Adapters\Doctrine\Repository;
use App\Auth\User;
use Doctrine\ORM\Exception\ORMException;

class DoctrineUserRepository extends Repository implements UserRepository
{
    public function save(User $user): bool
    {
        try {
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();
        }catch(ORMException $exception){
            return false;
        }
        return true;
    }

    public function getByEmail(string $email): ?User
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
