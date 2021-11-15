<?php

namespace App\Providers;

use App\Modules\Fronts\Home\Repositories\HomeRepository;
use App\Modules\Fronts\Home\Services\HomeService;
use Illuminate\Support\ServiceProvider;
use File;

class AppModuleFrontsProvider extends ServiceProvider
{
    private $baseFolderModule = 'Modules/Fronts';
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $bindings = [
            HomeService::class => HomeRepository::class
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
        $directories = array_map('basename', File::directories(app_path($this->baseFolderModule)));

        foreach ($directories as $moduleName) {
            $moduleConfigPath = app_path($this->baseFolderModule . '/' . $moduleName . '/config' . '/');
            $moduleLangPath = app_path($this->baseFolderModule . '/' . $moduleName . '/Lang' . '/');
            $moduleViewPath = app_path($this->baseFolderModule . '/' . $moduleName . '/Views' . '/');

            // boot languages
            if (File::exists($moduleConfigPath)) {
                $listFile = glob($moduleConfigPath . '*.php');
                if (sizeof($listFile) > 0) {
                    foreach ($listFile as $path) {
                        $alias = $moduleName . '::' . Str::of($path)->basename('.php');
                        $this->mergeConfigFrom($path, $alias);
                    }
                }
            }

            // boot languages
            if (File::exists($moduleLangPath)) {
                $this->loadTranslationsFrom($moduleLangPath, $moduleName);
            }

            // boot views
            if (File::exists($moduleViewPath)) {
                $this->loadViewsFrom($moduleViewPath, $moduleName);
            }
        }
    }
}
