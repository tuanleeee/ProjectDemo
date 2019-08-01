<?php

namespace App\Modules\ChatModule\Services;

use App\Modules\ChatModule\Model\Messages;
use Illuminate\Http\Request;

class ChatServices {
    public function saveMess(Request $request)  {
        return Messages::create($request->all());
    }
}