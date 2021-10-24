<?php

namespace Modules\Manager\Services\Manager\DTOs;

class UpdateManagerDTO
{
    public function __construct(
        private string $email
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }
}
