<?php

namespace Modules\Manager\Entities;

use App\Auth\RoleEnum;
use App\Auth\User;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Embeddable]
class Manager extends User
{
    public function getRole(): string
    {
        return RoleEnum::MANAGER;
    }
}
