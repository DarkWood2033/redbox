<?php

namespace Modules\Client\Repositories\Visit;

use App\Adapters\Doctrine\Repository;
use Doctrine\ORM\Exception\ORMException;
use Modules\Client\Entities\Visit;

class DoctrineVisitRepository extends Repository implements VisitRepository
{
    public function save(Visit $visit): bool
    {
        try {
            $this->getEntityManager()->persist($visit);
            $this->getEntityManager()->flush();
        }catch(ORMException $exception){
            return false;
        }
        return true;
    }
}
