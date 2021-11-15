<?php

use App\Modules\Admins\Ideas\Controllers\CategoryController;
use App\Modules\Admins\Ideas\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'category'], function (){
    Route::get('/', [CategoryController::class, 'index'])->name('category.list');
    Route::get('/add', [CategoryController::class, 'add'])->name('category.add');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/add', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/delete', [CategoryController::class, 'destroy'])->name('category.destroy');
});

Route::group(['prefix' => 'idea'], function (){
    Route::get('/', [IdeaController::class, 'index'])->name('idea');
    Route::get('/list', [IdeaController::class, 'index'])->name('idea.list');
    Route::get('/add', [IdeaController::class, 'add'])->name('idea.add');
    Route::get('/edit/{id}', [IdeaController::class, 'edit'])->name('idea.edit');
    Route::post('/add', [IdeaController::class, 'create'])->name('idea.create');
    Route::post('/edit/{id}', [IdeaController::class, 'update'])->name('idea.update');
    Route::post('/delete', [IdeaController::class, 'destroy'])->name('idea.destroy');
});

