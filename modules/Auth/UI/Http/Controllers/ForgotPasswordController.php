<?php

namespace Modules\Auth\UI\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Auth\Tasks\SendResetLinkTask;
use Modules\Auth\UI\Http\Requests\ForgotPasswordRequest;

class ForgotPasswordController
{
    public function form(): Factory|View|Application
    {
        return view('auth::ForgotPassword');
    }

    public function make(ForgotPasswordRequest $request, SendResetLinkTask $task): RedirectResponse
    {
        if($task->run($request->get('email'))){
            return back()->with('status', 'Вы успешно отправили письмо');
        }
        return back()->with('status', 'Не удалось отправить письмо.');
    }
}
