<?php

namespace App\Modules\ChatModule;

use File;
use App\Modules\ModuleContract;


class ChatServiceProvider extends ModuleContract {
    
    protected $module = "ChatModule";

    public function boot() {
        $this->discover();
    }
    public function register() {}
}