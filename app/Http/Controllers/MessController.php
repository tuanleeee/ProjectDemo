<?php

namespace App\Http\Controllers;

use App\Events\RedisEvent;
use App\Message;
use Illuminate\Http\Request;
use Session;

class MessController extends Controller
{
    public function index() {
        $messages = Message::all();
        return view('sendMessage', compact('messages'));
    }

    public function postMess(Request $request) {
        $messages = Message::create($request->all());
        event(
            $e = new RedisEvent($messages)
        );
        return redirect('chat');

//        Session::flash('postMess');
//        return view('sendMessage');
    }

}
