<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function messages(){
        return $this->hasMany(App\Message::class);
    }

    public function customer(){
        return $this->belongsTo(App\Customer::class);
    }

    public function user(){
        return $this->belongsTo(App\User::class);
    }
}
