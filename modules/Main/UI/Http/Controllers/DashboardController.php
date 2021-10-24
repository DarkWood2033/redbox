<?php

namespace Modules\Main\UI\Http\Controllers;

use App\Auth\RoleEnum;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController
{
    public function __construct(
        private AuthManager $authManager
    ) {}

    public function home(): Factory|View|Application
    {
        if($identifier = $this->authManager->guard()->user()->getRole() == RoleEnum::ADMINISTRATOR){
            return view('main::HomeAdministrator');
        }
        return view('main::HomeManager');
    }
}
