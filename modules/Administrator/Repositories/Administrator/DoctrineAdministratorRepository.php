<?php

namespace Modules\Administrator\Repositories\Administrator;

use App\Adapters\Doctrine\Repository;
use Doctrine\ORM\Exception\ORMException;
use Exception;
use Modules\Administrator\Entities\Administrator;
use Modules\Administrator\Exceptions\AdministratorException;

class DoctrineAdministratorRepository extends Repository implements AdministratorRepository
{
    public function save(Administrator $administrator): bool
    {
        try {
            $this->getEntityManager()->persist($administrator);
            $this->getEntityManager()->flush();
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function remove(Administrator $administrator): bool
    {
        try {
            $this->getEntityManager()->remove($administrator);
            $this->getEntityManager()->flush();
        } catch (ORMException $e) {
            return false;
        }
        return true;
    }

    public function getAll(): array
    {
        return $this->createQueryBuilder('a')->getQuery()->getResult();
    }

    public function findById($id): Administrator
    {
        $administrator = $this->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if(!$administrator){
            throw AdministratorException::notFoundById($id);
        }
        return $administrator;
    }
}
