<?php

use App\Auth\RoleEnum;
use Illuminate\Support\Facades\Route;
use Modules\Administrator\UI\Http\Controllers\CrudAdministratorController;

Route::middleware(['web', 'auth', 'role:'. RoleEnum::ADMINISTRATOR])->group(function(){
    Route::resource('administrators', CrudAdministratorController::class)
        ->parameter('administrators', 'id');
});
