<?php

namespace Modules\Manager\Repositories\Manager;

use Modules\Manager\Entities\Manager;

interface ManagerRepository
{
    public function save(Manager $manager): bool;

    public function remove(Manager $manager): bool;

    /**
     * @return Manager[]
     */
    public function getAll(): array;

    public function findById($id): Manager;
}
