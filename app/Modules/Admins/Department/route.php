<?php


use App\Modules\Admins\Department\Controllers\DepartmentController;
use App\Modules\Admins\Department\Controllers\StaffController;
use App\Modules\Admins\Products\Controllers\CategoryController;
use App\Modules\Admins\Products\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//Catalog
Route::group(['prefix' => 'department'], function (){
    Route::get('/', [DepartmentController::class, 'index'])->name('department.list');
    Route::get('/add', [DepartmentController::class, 'add'])->name('department.add');
    Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('/add', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('/edit/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::post('/delete', [DepartmentController::class, 'destroy'])->name('department.destroy');
});


Route::group(['prefix' => 'staff'], function (){
    Route::get('/', [StaffController::class, 'index'])->name('staff.list');
    Route::get('/add', [StaffController::class, 'add'])->name('staff.add');
    Route::get('/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::post('/add', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/edit/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::post('/delete', [StaffController::class, 'destroy'])->name('staff.destroy');
});
