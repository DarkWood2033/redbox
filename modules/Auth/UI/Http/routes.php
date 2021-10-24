<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\UI\Http\Controllers\AuthorizationController;
use Modules\Auth\UI\Http\Controllers\ForgotPasswordController;
use Modules\Auth\UI\Http\Controllers\ResetPasswordController;

Route::middleware(['web'])->group(function(){
    Route::get('login', [AuthorizationController::class, 'form'])
        ->middleware(['guest'])
        ->name('form');

    Route::post('login', [AuthorizationController::class, 'login'])
        ->middleware(['guest'])
        ->name('login');

    Route::get('logout', [AuthorizationController::class, 'logout'])
        ->middleware(['auth'])
        ->name('logout');

    Route::get('forgot-password', [ForgotPasswordController::class, 'form'])
        ->middleware('guest')
        ->name('forgot_password.form');

    Route::post('forgot-password', [ForgotPasswordController::class, 'make'])
        ->middleware('guest')
        ->name('forgot_password.send');

    Route::get('reset-password/{email}/{hash}', [ResetPasswordController::class, 'form'])
        ->middleware('guest')
        ->name('reset_password.form');

    Route::post('reset-password', [ResetPasswordController::class, 'make'])
        ->middleware('guest')
        ->name('reset_password.reset');
});

