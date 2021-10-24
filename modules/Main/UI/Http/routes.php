<?php

use Illuminate\Support\Facades\Route;
use Modules\Main\UI\Http\Controllers\DashboardController;

Route::middleware(['web', 'auth'])->group(function(){
    Route::get('/', [DashboardController::class, 'home'])
        ->name('home');
});
