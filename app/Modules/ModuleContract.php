<?php

namespace App\Modules;

use File;

abstract class ModuleContract extends \Illuminate\Support\ServiceProvider{
    
    protected $module; //string

    public function discover(){
        $module = $this->module;

        if(file_exists(__DIR__.'\\'.$module.'\\Route\\api.php')) {
            include __DIR__.'\\'.$module.'\\Route\\api.php';
        }

        if(is_dir(__DIR__.'\\'.$module.'\\Views')) {
            $this->loadViewsFrom(__DIR__.'\\'.$module.'\\Views',$module);
        }

        if (is_dir(__DIR__.'\\'.$module.'\\Migrations')) {
            $this->loadMigrationsFrom(__DIR__.'\\'.$module.'\\Migrations'); 
        }

        //dd(__DIR__.'\\'.$module.'\\Migrations');
    }
}