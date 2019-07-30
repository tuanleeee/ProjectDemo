<?php

namespace App\Modules\AuthModule;

use File;
use App\Modules\ModuleContract;


class AuthServiceProvider extends  ModuleContract{
    
    protected $module = "AuthModule";
    
    public function boot(){
        $this->discover();
    }
    public function register(){}
}