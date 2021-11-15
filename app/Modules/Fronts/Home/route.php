<?php

use App\Modules\Fronts\Home\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get("/home", [HomeController::class, 'index'])->name("home");
Route::get("/profile", [HomeController::class, 'profile'])->name("profile");
Route::get("/change-password", [HomeController::class, 'changePassword'])->name("change-password");
Route::get("/detail/{id}", [HomeController::class, 'detail'])->name("detail");
Route::get('/my-idea', [HomeController::class, 'myIdea'])->name("my-idea");
Route::post("/post-idea", [HomeController::class, 'postIdea'])->name("post-idea");
Route::post("/post-comment", [HomeController::class, 'postComment'])->name("post-comment");
Route::post("/profile", [HomeController::class, 'saveProfile'])->name("profile.post");
Route::post("/change-password", [HomeController::class, 'postChangePassword'])->name("change-password.post");
