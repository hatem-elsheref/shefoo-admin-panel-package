<?php

namespace Shefoo\Frontend\Dashboard;

use Illuminate\Support\ServiceProvider;
use Shefoo\Frontend\Dashboard\Console\Commands\InstallShefooAdminPanel;
class AdminPanelServiceProvider extends ServiceProvider
{

    const MAIN_PATH    = __DIR__.DIRECTORY_SEPARATOR;
    const VENDOR_NAME  = 'SHEFOO';
    const CONFIG_FILES = ['shefoo-admin-panel','shefoo-admin-panel-sidebar'];
    const ROUTE_FILES  = ['shefoo-admin-panel.php'];

    const RESOURCES_DIR = 'resources';
    const ASSETS_DIR = 'dashboard_assets';
    const CONFIG_DIR = 'config';
    const ROUTE_DIR = 'routes';
    const LANG_DIR = 'lang';
    const VIEW_DIR = 'views';
    const HTTP_BACKEND_DIR = 'Http' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'Backend';


    public function register(){}

    private function loadConfigFiles(array $files){

        foreach ($files as $file){
            $this->mergeConfigFrom(self::MAIN_PATH.self::CONFIG_DIR.DIRECTORY_SEPARATOR.$file.'.php',$file);
        }
    }

    private function loadRoutesFiles(array $files){

        foreach ($files as $file){
            $this->loadRoutesFrom(self::MAIN_PATH.self::ROUTE_DIR.DIRECTORY_SEPARATOR.$file);
        }
    }

    private function loadViewsAndTranslations(string $path = 'Backend/shefoo-admin-panel'){

        $view_full_path = self::MAIN_PATH . self::RESOURCES_DIR . DIRECTORY_SEPARATOR . self::VIEW_DIR;
        $lang_full_path = self::MAIN_PATH . self::RESOURCES_DIR . DIRECTORY_SEPARATOR . self::LANG_DIR;

        $view_full_path = (is_null($path)) ? $view_full_path : $view_full_path . DIRECTORY_SEPARATOR . $path;
//        $lang_full_path = (is_null($path)) ? $lang_full_path : $lang_full_path . DIRECTORY_SEPARATOR . $path;

        $this->loadViewsFrom($view_full_path,self::VENDOR_NAME);
        $this->loadTranslationsFrom($lang_full_path,self::VENDOR_NAME);
    }

    private function preparePublishFiles(){

        $publish_files = [
            self::MAIN_PATH . self::ASSETS_DIR => public_path('assets' . DIRECTORY_SEPARATOR.self::ASSETS_DIR),
            self::MAIN_PATH . self::RESOURCES_DIR => base_path('resources'),
            self::MAIN_PATH . self::HTTP_BACKEND_DIR => app_path(self::HTTP_BACKEND_DIR)
        ];


        foreach (self::CONFIG_FILES as $config_file){
            $publish_files[self::MAIN_PATH.self::CONFIG_DIR.DIRECTORY_SEPARATOR.$config_file.'.php'] = config_path($config_file.'.php');
        }

        foreach (self::ROUTE_FILES as $route_file){
            $publish_files[self::MAIN_PATH.self::ROUTE_DIR.DIRECTORY_SEPARATOR.$route_file] = base_path('routes'.DIRECTORY_SEPARATOR.$route_file);
        }

        return $publish_files;
    }

    public function boot()
    {
        $this->loadViewsAndTranslations();

        $this->loadConfigFiles(self::CONFIG_FILES);

        $this->loadRoutesFiles(self::ROUTE_FILES);

        $publish_files = $this->preparePublishFiles();

        $this->publishes($publish_files,'all');

        if ($this->app->runningInConsole()) {
            $this->commands([InstallShefooAdminPanel::class]);
        }
    }
}
