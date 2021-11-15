<?php

namespace App\Providers;

use App\Models\Menu;
use App\Modules\Admins\Dashboard\Repositories\DashboardRepository;
use App\Modules\Admins\Dashboard\Services\DashboardService;
use App\Modules\Admins\Department\Repositories\DepartmentRepository;
use App\Modules\Admins\Department\Repositories\StaffRepository;
use App\Modules\Admins\Department\Services\DepartmentService;
use App\Modules\Admins\Department\Services\StaffService;
use App\Modules\Admins\Ideas\Repositories\CategoryRepository;
use App\Modules\Admins\Ideas\Repositories\IdeaRepository;
use App\Modules\Admins\Ideas\Services\CategoryService;
use App\Modules\Admins\Ideas\Services\IdeaService;
use App\Modules\Admins\Users\Repositories\RoleRepository;
use App\Modules\Admins\Users\Services\RoleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Modules\Admins\Users\Services\UserService;
use App\Modules\Admins\Example\Services\ExampleService;
use App\Modules\Admins\Users\Services\PermissionService;
use App\Modules\Admins\Users\Repositories\UserRepository;
use App\Modules\Admins\Example\Repositories\ExampleRepository;
use App\Modules\Admins\Users\Repositories\PermissionRepository;

class AppAdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $bindings = [
            ExampleService::class => ExampleRepository::class,
            CategoryService::class => CategoryRepository::class,
            UserService::class => UserRepository::class,
            PermissionService::class => PermissionRepository::class,
            RoleService::class => RoleRepository::class,
            IdeaService::class => IdeaRepository::class,
            DepartmentService::class => DepartmentRepository::class,
            StaffService::class => StaffRepository::class,
            DashboardService::class => DashboardRepository::class,
        ];

        foreach ($bindings as $key => $value) {
            $this->app->bind($key, $value);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view) {
            if (Auth::guard("admin")->check()){
                $user = Auth::guard("admin")->user();
                $menus = Menu::select('*')
                    ->join("dtb_permission_role as pr", "mtb_menu.id", "=", "pr.menu_id")
                    ->where("role_id", "=", $user->role_id)
                    ->where("pr.view_flg", true)
                    ->orderBy("menu_sort", "asc")
                    ->get();
                $view->with("menus", $menus);
            }
        });
    }
}
