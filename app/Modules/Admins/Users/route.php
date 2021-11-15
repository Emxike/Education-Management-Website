<?php

use App\Modules\Admins\Products\Controllers\ProductController;
use App\Modules\Admins\Users\Controllers\PermissionController;
use App\Modules\Admins\Users\Controllers\RoleController;
use App\Modules\Admins\Users\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "role"], function (){
    Route::get("/", [RoleController::class, 'index'])->name("role.list");
    Route::get("/add", [RoleController::class, 'add'])->name("role.add");
    Route::post("/add", [RoleController::class, 'create'])->name("role.create");
    Route::get("/edit/{id}", [RoleController::class, 'edit'])->name("role.edit");
    Route::post("/edit/{id}", [RoleController::class, 'update'])->name("role.update");
    Route::post("/delete", [RoleController::class, 'destroy'])->name("role.destroy");
});

//Member
Route::group(['prefix' => 'member'], function (){
    Route::get('/', [UserController::class, 'index'])->name('member.list');
    Route::get('/add', [UserController::class, 'add'])->name('member.add');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('member.edit');
    Route::post('/add', [UserController::class, 'create'])->name('member.create');
    Route::post('/edit/{id}', [UserController::class, 'update'])->name('member.update');
    Route::post('/delete', [UserController::class, 'destroy'])->name('member.destroy');
    Route::post('/lock', [UserController::class, 'lock'])->name('member.lock');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('member.change.password');
});

Route::group(["prefix" => "permission"], function (){
    Route::get('/', [PermissionController::class ,'index'])->name('permission');
    Route::post('/add', [PermissionController::class ,'save'])->name('permission.add');
});



Route::group(["prefix" => "setting"], function (){
    Route::get("/profile", "Admin\SettingController@profile")->name("setting.profile");
    Route::post("/profile/{id}", "Admin\SettingController@doProfile")->name("setting.profile.do");
    Route::get("/change-password","Admin\SettingController@changePassword")->name("setting.changePassword");
    Route::post("/change-password/{id}","Admin\SettingController@doChangePassword")->name("setting.changePassword.do");
});

Route::group(['prefix' => 'common'], function (){
    Route::post('/remove-image','Admin\UploadController@doRemoveImage')->name('common.remove.image');
    Route::post('/delete-image','Admin\UploadController@doDeleteImage')->name('common.delete.image');
    Route::post('/upload-image','Admin\UploadController@doAddImage')->name('common.upload.image');
});

//Customer
Route::group(['prefix' => 'customer'], function (){
    Route::get('/', [ProductController::class, 'index'])->name('customer.list');
    Route::get('/add', [ProductController::class, 'add'])->name('customer.add');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('customer.edit');
    Route::post('/add', [ProductController::class, 'create'])->name('customer.create');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('customer.update');
    Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('customer.destroy');
});


