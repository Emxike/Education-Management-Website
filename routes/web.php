<?php

use App\Http\Controllers\Auth\LoginAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get("/", function () {
    return redirect()->route("home");
});
Route::middleware("auth:web")->group(function () {
    Route::group([], base_path('app/Modules/Fronts/Home/route.php'));
});

Route::get("/" . config("app.route_admin"), function () {
    return redirect()->route("admin.show");
});

Route::group(['prefix' => "/".config("app.route_admin")], function () {
    Route::middleware("auth:admin")->group(function () {
        Route::group([], base_path('app/Modules/Admins/Dashboard/route.php'));
        Route::group([], base_path('app/Modules/Admins/Example/route.php'));
        Route::group([], base_path('app/Modules/Admins/Ideas/route.php'));
        Route::group([], base_path('app/Modules/Admins/Users/route.php'));
        Route::group([], base_path('app/Modules/Admins/Department/route.php'));

        Route::get('/logout', [LoginAdminController::class, 'logout'])->name('admin.logout');
        Route::post('/logout', [LoginAdminController::class, 'logout'])->name('admin.logout.submit');
    });
    Route::get('/login', [LoginAdminController::class, 'getLogin'])->name('admin.show');
    Route::post('/login', [LoginAdminController::class, 'login'])->name('admin.login.submit');
});
