<?php

use App\Auth\RoleEnum;
use Illuminate\Support\Facades\Route;
use Modules\Client\UI\Http\Controllers\CrudClientController;
use Modules\Client\UI\Http\Controllers\VisitController;

Route::middleware(['web', 'auth'])->group(function(){
    Route::resource('clients', CrudClientController::class)
        ->parameter('clients', 'id')
        ->middleware(['role:'. RoleEnum::ADMINISTRATOR]);

    Route::get('visits/fix/{hash}', [VisitController::class, 'form'])
        ->name('visits.form')
        ->middleware(['role:'.RoleEnum::MANAGER]);

    Route::post('visits/fix/{client_id}', [VisitController::class, 'fix'])
        ->name('visits.fix')
        ->middleware(['role:'.RoleEnum::MANAGER]);
});
