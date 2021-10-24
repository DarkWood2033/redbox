<?php

namespace App\Adapters\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class Repository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private EntityRepository $entityRepository
    ) {}

    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    public function getEntityRepository(): EntityRepository
    {
        return $this->entityRepository;
    }

    protected function createQueryBuilder($alias = 'alias', $select = []): QueryBuilder
    {
        $query = $this->getEntityRepository()->createQueryBuilder($alias)
            ->select(array_merge([$alias], $select));
        foreach ($select as $value) {
            $query->leftJoin($alias . '.' . $value, $value);
        }
        return $query;
    }

    protected function findOneEntity($where = [], $select = [])
    {
        $query = $this->createQueryBuilder('alias', $select);
        foreach ($where as $key => $value) {
            $query
                ->andWhere('alias.' . $key . ' = :' . $key)
                ->setParameter($key, $value);
        }
        return $query->getQuery()
            ->getOneOrNullResult();
    }

    protected function findAllEntities($where = [], $select = [])
    {
        $query = $this->createQueryBuilder('alias', $select);
        foreach ($where as $key => $value) {
            $query
                ->where('alias.' . $key . ' = :' . $key)
                ->setParameter($key, $value);
        }
        return $query->getQuery()
            ->getResult();
    }
}
