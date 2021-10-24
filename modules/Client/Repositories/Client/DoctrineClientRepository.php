<?php

namespace Modules\Client\Repositories\Client;

use App\Adapters\Doctrine\Repository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\QueryBuilder;
use Modules\Client\Entities\Client;
use Modules\Client\Exceptions\ClientException;

class DoctrineClientRepository extends Repository implements ClientRepository
{
    public function save(Client $client): bool
    {
        try {
            $this->getEntityManager()->persist($client);
            $this->getEntityManager()->flush();
        }catch(ORMException $exception){
            return false;
        }
        return true;
    }

    public function remove(Client $client): bool
    {
        try {
            $this->getEntityManager()->remove($client);
            $this->getEntityManager()->flush();
        }catch(ORMException $exception){
            return false;
        }
        return true;
    }

    public function getByPhoneNumber(string $phone_number): ?Client
    {
        return $this->createQueryBuilder('c')
            ->where('c.phone_number = :phone_number')
            ->setParameter('phone_number', $phone_number)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAll(): array
    {
        return $this->createQueryBuilder()->getQuery()->getResult();
    }

    public function findById($id): Client
    {
        $client = $this->createQueryBuilder('c')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
        if(!$client){
            throw ClientException::notFoundById($id);
        }
        return $client;
    }

    public function findByHash($hash): Client
    {
        $client = $this->createQueryBuilder('c')
            ->where('c.hash = :hash')
            ->setParameter('hash', $hash)
            ->getQuery()
            ->getOneOrNullResult();
        if(!$client){
            throw ClientException::notFoundByHash($hash);
        }
        return $client;
    }
}
