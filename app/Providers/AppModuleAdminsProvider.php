<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use File;

class AppModuleAdminsProvider extends ServiceProvider
{
    private $baseFolderModuleAdmin = 'Modules/Admins';
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $directories = array_map('basename', File::directories(app_path($this->baseFolderModuleAdmin)));

        foreach ($directories as $moduleName) {
            $moduleConfigPathAdmin = app_path($this->baseFolderModuleAdmin . '/' . $moduleName . '/config' . '/');
            $moduleLangPath = app_path($this->baseFolderModuleAdmin . '/' . $moduleName . '/Lang' . '/');
            $moduleViewPath = app_path($this->baseFolderModuleAdmin . '/' . $moduleName . '/Views' . '/');

            // boot languages
            if (File::exists($moduleConfigPathAdmin)) {
                $listFile = glob($moduleConfigPathAdmin . '*.php');
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
