<?php

namespace Modules\Auth\UI\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Modules\Auth\DTOs\LoginDTO;
use Modules\Auth\Tasks\AuthenticationTask;
use Modules\Auth\Tasks\LogoutTask;
use Modules\Auth\UI\Http\Requests\LoginRequest;

class AuthorizationController extends Controller
{
    const ROUTE_HOME = 'home';
    const ROUTE_LOGIN = 'login';

    public function form(): Factory|View|Application
    {
        return view('auth::Login');
    }

    public function login(LoginRequest $request, AuthenticationTask $task): Redirector|RedirectResponse|Application
    {
        $DTO = new LoginDTO($request->get('email'), $request->get('password'));

        if($task->run($DTO)){
            return redirect(route(self::ROUTE_HOME));
        }
        return redirect(route('login'))->withInput()->with('message', 'Введен неверный логин или пароль');
    }

    public function logout(LogoutTask $task): Redirector|Application|RedirectResponse
    {
        $task->run();
        return redirect(route(self::ROUTE_LOGIN));
    }
}
