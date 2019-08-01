<?php

namespace App\Modules\AuthModule\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;


class SysUser extends Authenticatable
{
    use Notifiable,HasApiTokens;

    protected $table = 'sysusers';
    
    protected $fillable = [
        'first_name','middle_name','last_name','date_of_birth','gender','phone','email','address','username','password','user_role','image'
    ];

    protected $attributes = array(
        'first_name' => "",
		'middle_name' =>"",
		'last_name' => "",
		'date_of_birth' => "2018-08-08",
		'phone' => "123456789",
		'address' => "",
        'image' => "noImage.jpeg"
    );

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*public function conversations(){
        return $this->hasMany(App\Conversation::class);
    }*/

    public function isOnline(){
        return Cache::has('user-is-online-'.$this->id);
    }
    
}
