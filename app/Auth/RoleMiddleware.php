<?php

namespace App\Auth;

use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class RoleMiddleware
{
    public function __construct(
        private AuthManager $authManager
    ) {}

    public function handle(Request $request, Closure $next, $role)
    {
        if(!$role){
            abort(403);
        }

        if(!$this->isAuthorized()){
            abort(403);
        }

        if(!$this->checkRole($role)){
            abort(403);
        }

        return $next($request);
    }

    private function isAuthorized(): bool
    {
        return $this->authManager->guard()->check();
    }

    private function checkRole($role): bool
    {
        $identifier = $this->authManager->guard()->user();

        if(!method_exists($identifier, 'getRole')){
            return false;
        }

        return $identifier->getRole() === $role;
    }
}
