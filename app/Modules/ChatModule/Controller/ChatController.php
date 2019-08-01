<?php

namespace App\Modules\ChatModule\ChatController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ChatModule\Model\Messages;
use App\Modules\ChatModule\Events\RedisEvent;
use App\Modules\ChatModule\Services\ChatServices;

class ChatController extends Controller {

    private $chatServices ;

    public function __construct(ChatServices $chatServices){
        $this->chatServices = $chatServices;
    }

    public function index() {
        $messages = Messages::all();
        return view('ChatModule::chat', compact('messages'));
    }

    public function postMess(Request $request) {
        // $messages = Messages::create($request->all());
        $messages = $this->chatServices->saveMess($request);
        event(
            $e = new RedisEvent($messages)
        );
        return redirect('chat');
    }

    public function supporter(Request $resquest) {
        return view('ChatModule::supporter');
    }
}