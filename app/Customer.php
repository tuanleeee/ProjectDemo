<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function conversations(){
        return $this->hasMany(App\Conversation::class);
    }
}
