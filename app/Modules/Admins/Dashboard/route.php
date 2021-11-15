<?php

use App\Modules\Admins\Example\Controllers\ExampleController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'dashboard'], function (){
    Route::get('/', [\App\Modules\Admins\Dashboard\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

