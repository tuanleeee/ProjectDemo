<?php

namespace App\Modules\AuthModule;

//use File;
use App\Modules\ModuleContract;


class AuthServiceProvider extends  ModuleContract{
    
    protected $module = "AuthModule";
    
    
    public function boot(){
        $this->discover();
        if (file_exists(__DIR__./*'\\'.$this->module.*/'\\Config.php')) {
            $this->mergeConfigFrom(__DIR__./*'\\'.$this->module.*/'\\Config.php',$this->module.'_config');
        }
        $this->app->bind('App\FailValidationInterface','App\Modules\AuthModule\FailValidator\FailValidator');
    }
    public function register(){
        
    }
}