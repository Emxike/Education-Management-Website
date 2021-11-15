<?php

use App\Modules\Admins\Products\Controllers\DepartmentController;
use App\Modules\Admins\Products\Controllers\CategoryController;
use App\Modules\Admins\Products\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//Catalog
Route::group(['prefix' => 'catalog'], function (){
    Route::get('/', [DepartmentController::class, 'index'])->name('catalog.list');
    Route::get('/add', [DepartmentController::class, 'add'])->name('catalog.add');
    Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('catalog.edit');
    Route::post('/add', [DepartmentController::class, 'create'])->name('catalog.create');
    Route::post('/edit/{id}', [DepartmentController::class, 'update'])->name('catalog.update');
    Route::post('/delete/{id}', [DepartmentController::class, 'destroy'])->name('catalog.destroy');
});

//Category
Route::group(['prefix' => 'category'], function (){
    Route::get('/', [CategoryController::class, 'index'])->name('category.list');
    Route::get('/add', [CategoryController::class, 'add'])->name('category.add');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/add', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

//Product
Route::group(['prefix' => 'product'], function (){
    Route::get('/', [ProductController::class, 'index'])->name('product.list');
    Route::get('/add', [ProductController::class, 'add'])->name('product.add');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/add', [ProductController::class, 'create'])->name('product.create');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

//Slider
Route::group(['prefix' => 'slider'], function (){
    Route::get('/', [ProductController::class, 'index'])->name('slider.list');
    Route::get('/add', [ProductController::class, 'add'])->name('slider.add');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('slider.edit');
    Route::post('/add', [ProductController::class, 'create'])->name('slider.create');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('slider.update');
    Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('slider.destroy');
});

//Order
Route::group(['prefix' => 'order'], function (){
    Route::get('/', [ProductController::class, 'index'])->name('order.list');
    Route::get('/add', [ProductController::class, 'add'])->name('order.add');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('order.edit');
    Route::post('/add', [ProductController::class, 'create'])->name('order.create');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('order.update');
    Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('order.destroy');
});

//Discount
Route::group(['prefix' => 'discount'], function (){
    Route::get('/', [ProductController::class, 'index'])->name('discount.list');
    Route::get('/add', [ProductController::class, 'add'])->name('discount.add');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('discount.edit');
    Route::post('/add', [ProductController::class, 'create'])->name('discount.create');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('discount.update');
    Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('discount.destroy');
});

//Store
Route::group(['prefix' => 'store'], function (){
    Route::get('/', [ProductController::class, 'index'])->name('store.list');
    Route::get('/add', [ProductController::class, 'add'])->name('store.add');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('store.edit');
    Route::post('/add', [ProductController::class, 'create'])->name('store.create');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('store.update');
    Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('store.destroy');
});

//Mail-follow
Route::group(['prefix' => 'mail-follow'], function (){
    Route::get('/', [ProductController::class, 'index'])->name('mail-follow.list');
    Route::get('/add', [ProductController::class, 'add'])->name('mail-follow.add');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('mail-follow.edit');
    Route::post('/add', [ProductController::class, 'create'])->name('mail-follow.create');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('mail-follow.update');
    Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('mail-follow.destroy');
});

//Mail-follow
Route::group(['prefix' => 'mail-follow'], function (){
    Route::get('/', [ProductController::class, 'index'])->name('mail-follow.list');
    Route::get('/add', [ProductController::class, 'add'])->name('mail-follow.add');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('mail-follow.edit');
    Route::post('/add', [ProductController::class, 'create'])->name('mail-follow.create');
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('mail-follow.update');
    Route::post('/delete/{id}', [ProductController::class, 'destroy'])->name('mail-follow.destroy');
});

Route::group(["prefix" => "news"], function (){
    Route::get("/", [ProductController::class, 'index'])->name("news.list");
    Route::get("/add", [ProductController::class, 'index'])->name("news.add");
    Route::post("/add", [ProductController::class, 'index'])->name("news.add.do");
    Route::get("/edit/{id}", [ProductController::class, 'index'])->name("news.edit");
    Route::post("/edit/{id}", [ProductController::class, 'index'])->name("news.edit.do");
    Route::post("/delete", [ProductController::class, 'index'])->name("news.delete.do");
});

Route::group(["prefix" => "messages"], function (){
    Route::get("/", [ProductController::class, 'index'])->name("messages.list");
    Route::get("/add", [ProductController::class, 'add'])->name("messages.add");
    Route::post("/add", [ProductController::class, 'index'])->name("messages.add.do");
    Route::get("/edit/{id}", [ProductController::class, 'index'])->name("messages.edit");
    Route::post("/edit/{id}", [ProductController::class, 'index'])->name("messages.edit.do");
    Route::post("/delete", [ProductController::class, 'index'])->name("messages.delete.do");
});

Route::group(["prefix" => "deals-day"], function (){
    Route::get("/", [ProductController::class, 'index'])->name("deals-day.list");
    Route::get("/add", [ProductController::class, 'add'])->name("deals-day.add");
    Route::post("/add", [ProductController::class, 'index'])->name("deals-day.add.do");
    Route::get("/edit/{id}", [ProductController::class, 'index'])->name("deals-day.edit");
    Route::post("/edit/{id}", [ProductController::class, 'index'])->name("deals-day.edit.do");
    Route::post("/delete", [ProductController::class, 'index'])->name("deals-day.delete.do");
});



Route::get('/contact', [ProductController::class ,'index'])->name('contact');
Route::get('/introduce', [ProductController::class ,'index'])->name('introduce');
