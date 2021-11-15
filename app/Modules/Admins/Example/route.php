<?php

use App\Modules\Admins\Example\Controllers\ExampleController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'example'], function (){
    Route::get('/', [ExampleController::class, 'index'])->name('example.index');
    Route::get('/add', [ExampleController::class, 'add'])->name('example.add');
    Route::get('/edit/{id}', [ExampleController::class, 'edit'])->name('example.edit');
    Route::post('/add', [ExampleController::class, 'create'])->name('example.create');
    Route::post('/edit/{id}', [ExampleController::class, 'update'])->name('example.update');
    Route::post('/delete/{id}', [ExampleController::class, 'destroy'])->name('example.destroy');
});

