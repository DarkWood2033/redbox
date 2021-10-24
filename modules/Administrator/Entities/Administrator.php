<?php

namespace Modules\Administrator\Entities;

use App\Auth\RoleEnum;
use App\Auth\User;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Embeddable]
class Administrator extends User
{
    public function getRole(): string
    {
        return RoleEnum::ADMINISTRATOR;
    }
}
