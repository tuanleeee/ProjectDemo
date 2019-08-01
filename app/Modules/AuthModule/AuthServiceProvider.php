<?php

namespace App\Modules\AuthModule;

//use File;
use App\Modules\ModuleContract;


class AuthServiceProvider extends  ModuleContract{
    
    protected $module = "AuthModule";
    
    
    public function boot(){
        $this->discover();

        $this->app->bind('App\FailValidationInterface','App\Modules\AuthModule\FailValidator\FailValidator');
    }
    public function register(){
        
    }
}