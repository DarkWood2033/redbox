<?php

namespace Modules\Administrator\Services\Administrator\DTOs;

class UpdateAdministratorDTO
{
    public function __construct(
        private string $email
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }
}
