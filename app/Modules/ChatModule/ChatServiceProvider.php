<?php

namespace App\Modules\ChatModule;

use File;
use App\Modules\ModuleContract;


class ChatServiceProvider extends ModuleContract {
    
    protected $module = "ChatModule";

    public function boot() {
        $this->discover();
        $this->mergeConfigFrom(__DIR__.'\\Config\\config.php',$this->module.'_config');
    }
    public function register() {}
}