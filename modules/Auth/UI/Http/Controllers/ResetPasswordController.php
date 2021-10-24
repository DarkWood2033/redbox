<?php

namespace Modules\Auth\UI\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Modules\Auth\Repositories\ResetPassword\ResetPasswordRepository;
use Modules\Auth\Tasks\ResetPasswordTask;
use Modules\Auth\UI\Http\Requests\ResetPasswordRequest;

class ResetPasswordController
{
    public function __construct(
        private ResetPasswordRepository $resetPasswordRepository
    ) {}

    public function form($email, $hash): View|Factory|Redirector|RedirectResponse|Application
    {
        if(!$this->resetPasswordRepository->getActiveByEmailAndHash($email, $hash)){
            return redirect(route('login'));
        }
        return view('auth::ResetPassword', [
            'email' => $email,
            'hash' => $hash
        ]);
    }

    public function make(ResetPasswordRequest $request, ResetPasswordTask $task): Redirector|Application|RedirectResponse
    {
        if($task->run($request->get('email'), $request->get('hash'), $request->get('password'))){
            return redirect(route('login'))->with('message', 'Вы успешно восстановили пароль');
        }
        return redirect(route('login'))->with('message', 'Не удалось востановить пароль');
    }
}
