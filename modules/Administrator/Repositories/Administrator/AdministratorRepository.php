<?php

namespace Modules\Administrator\Repositories\Administrator;

use Modules\Administrator\Entities\Administrator;

interface AdministratorRepository
{
    public function save(Administrator $administrator): bool;

    public function remove(Administrator $administrator): bool;

    /**
     * @return Administrator[]
     */
    public function getAll(): array;

    public function findById($id): Administrator;
}
