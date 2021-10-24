<?php

namespace Modules\Auth\Tasks;

use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;

class LogoutTask
{
    public function __construct(
        private AuthManager $authManager
    ) {}

    public function run($guard_name = null): void
    {
        $this->guard($guard_name)->logout();
    }

    private function guard($guard_name): Guard|StatefulGuard
    {
        return $this->authManager->guard($guard_name);
    }
}
