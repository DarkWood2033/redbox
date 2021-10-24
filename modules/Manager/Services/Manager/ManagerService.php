<?php

namespace Modules\Manager\Services\Manager;

use Modules\Manager\Entities\Manager;
use Modules\Manager\Repositories\Manager\ManagerRepository;
use Modules\Manager\Services\Manager\DTOs\CreateManagerDTO;
use Modules\Manager\Services\Manager\DTOs\UpdateManagerDTO;

class ManagerService
{
    public function __construct(
        private ManagerRepository $managerRepository
    ) {}

    public function create(CreateManagerDTO $DTO): ?Manager
    {
        $manager = new Manager($DTO->getEmail(), $DTO->getPassword());
        if($this->managerRepository->save($manager)){
            return $manager;
        }
        return null;
    }

    public function update(Manager $manager, UpdateManagerDTO $DTO): bool
    {
        $manager->setEmail($DTO->getEmail());
        return $this->managerRepository->save($manager);
    }

    public function remove(Manager $manager): bool
    {
        return $this->managerRepository->remove($manager);
    }
}
