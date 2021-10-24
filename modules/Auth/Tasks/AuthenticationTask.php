<?php

namespace Modules\Auth\Tasks;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use JetBrains\PhpStorm\ArrayShape;
use Modules\Auth\DTOs\LoginDTO;

class AuthenticationTask
{
    public function __construct(
        private AuthManager $authManager
    ) {}

    public function run(LoginDTO $DTO, $guard_name = null): bool
    {
        return $this
            ->guard($guard_name)
            ->attempt($this->getCredentials($DTO));
    }

    private function guard($guard_name): Guard|StatefulGuard
    {
        return $this->authManager->guard($guard_name);
    }

    #[ArrayShape(['email' => "string", 'password' => "string"])]
    private function getCredentials(LoginDTO $DTO): array
    {
        return [
            'email' => $DTO->getEmail(),
            'password' => $DTO->getPassword()
        ];
    }
}
