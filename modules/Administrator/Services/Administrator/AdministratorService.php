<?php

namespace Modules\Administrator\Services\Administrator;

use Modules\Administrator\Entities\Administrator;
use Modules\Administrator\Repositories\Administrator\AdministratorRepository;
use Modules\Administrator\Services\Administrator\DTOs\CreateAdministratorDTO;
use Modules\Administrator\Services\Administrator\DTOs\UpdateAdministratorDTO;

class AdministratorService
{
    public function __construct(
        private AdministratorRepository $administratorRepository
    ) {}

    public function create(CreateAdministratorDTO $DTO): ?Administrator
    {
        $administrator = new Administrator($DTO->getEmail(), $DTO->getPassword());
        if($this->administratorRepository->save($administrator)){
            return $administrator;
        }
        return null;
    }

    public function update(Administrator $administrator, UpdateAdministratorDTO $DTO): bool
    {
        $administrator->setEmail($DTO->getEmail());
        return $this->administratorRepository->save($administrator);
    }

    public function remove(Administrator $administrator): bool
    {
        return $this->administratorRepository->remove($administrator);
    }
}
