<?php

namespace Modules\Auth\DTOs;

class LoginDTO
{
    public function __construct(
        private string $email,
        private string $password
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
