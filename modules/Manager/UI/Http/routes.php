<?php

use App\Auth\RoleEnum;
use Illuminate\Support\Facades\Route;
use Modules\Manager\UI\Http\Controllers\CrudManagerController;

Route::middleware(['web', 'auth', 'role:'. RoleEnum::ADMINISTRATOR])->group(function(){
    Route::resource('managers', CrudManagerController::class)
        ->parameter('managers', 'id');
});
