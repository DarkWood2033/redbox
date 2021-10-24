<?php

namespace Modules\Manager\Repositories\Manager;

use App\Adapters\Doctrine\Repository;
use Doctrine\ORM\Exception\ORMException;
use Modules\Manager\Entities\Manager;
use Modules\Manager\Exceptions\ManagerException;

class DoctrineManagerRepository extends Repository implements ManagerRepository
{
    public function save(Manager $manager): bool
    {
        try {
            $this->getEntityManager()->persist($manager);
            $this->getEntityManager()->flush();
        }catch(ORMException $exception){
            return false;
        }
        return true;
    }

    public function remove(Manager $manager): bool
    {
        try {
            $this->getEntityManager()->remove($manager);
            $this->getEntityManager()->flush();
        }catch(ORMException $exception){
            return false;
        }
        return true;
    }

    public function getAll(): array
    {
        return $this->createQueryBuilder()->getQuery()->getResult();
    }

    public function findById($id): Manager
    {
        $manager = $this->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        if(!$manager){
            throw ManagerException::notFoundById($id);
        }
        return $manager;
    }
}
