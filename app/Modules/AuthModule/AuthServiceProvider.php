<?php

namespace App\Modules\AuthModule;

//use File;
use App\Modules\ModuleContract;
use Laravel\Passport\Passport;
use App\Modules\AuthModule\Contracts\FailValidationInterface;
use App\Modules\AuthModule\Implementations\FailValidator;


class AuthServiceProvider extends  ModuleContract{
    
    protected $module = "AuthModule";
    
    
    public function boot(){
        
        $this->app->bind(FailValidationInterface::class,
			FailValidator::class);

	//dd(__DIR__.'/Contracts/FailValidationInteface');
	$expireDay = now()
                    ->addMonths(config('AuthModule_config.token.expiration.months'))
                    ->addDays(config('AuthModule_config.token.expiration.days'));
        Passport::personalAccessTokensExpireIn($expireDay);
    
    }
    public function register(){

        if (file_exists(__DIR__./*'\\'.$this->module.*/'/Config.php')) {
            $this->mergeConfigFrom(__DIR__./*'\\'.$this->module.*/'/Config.php',$this->module.'_config');
        }
        $this->discover();
    }
}
