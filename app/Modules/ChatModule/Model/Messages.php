<?php

namespace App\Modules\ChatModule\Model;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = "messages";

    protected $fillable = ['username', 'content'];

    protected $attributes = array(
        'username' => "",
        'content' => "",
        'request' => "Customer"
    );
}
