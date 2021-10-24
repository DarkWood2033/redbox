<?php

namespace Modules\Auth\Repositories\ResetPassword;

use App\Adapters\Doctrine\Repository;
use Doctrine\ORM\Exception\ORMException;
use Modules\Auth\Entities\ResetPassword;

class DoctrineResetPasswordRepository extends Repository implements ResetPasswordRepository
{
    public function save(ResetPassword $resetPassword): bool
    {
        try {
            $this->getEntityManager()->persist($resetPassword);
            $this->getEntityManager()->flush();
        }catch (ORMException $exception){
            return false;
        }
        return true;
    }

    public function remove(ResetPassword $resetPassword): bool
    {
        try {
            $this->getEntityManager()->remove($resetPassword);
            $this->getEntityManager()->flush();
        }catch (ORMException $exception){
            return false;
        }
        return true;
    }

    public function getActiveByEmailAndHash(string $email, string $hash): ?ResetPassword
    {
        return $this->createQueryBuilder('r')
            ->where('r.email = :email')
            ->setParameter('email', $email)
            ->andWhere('r.hash = :hash')
            ->setParameter('hash', $hash)
            ->andWhere('r.used_at is null')
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAllByEmail(string $email): array
    {
        return $this->createQueryBuilder('r')
            ->where('r.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getResult();
    }
}
