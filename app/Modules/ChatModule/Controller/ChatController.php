<?php

namespace App\Modules\ChatModule\ChatController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\ChatModule\Events\RedisEvent;
use App\Modules\ChatModule\Services\ChatServices;

class ChatController extends Controller {

    private $chatServices ;

    public function __construct(ChatServices $chatServices){
        $this->chatServices = $chatServices;
    }

    public function index() {
        $messages = $this->chatServices->getAllMess();
        return view('ChatModule_view::chat', compact('messages'));
    }

    public function postMess(Request $request) {
        $messages = $this->chatServices->saveMess($request);
        event(
            $e = new RedisEvent($messages)
        );
	dd('Im in chat controller');
        return redirect('chat');
    }

    public function supporter(Request $resquest) {
        $value = config('ChatModule_config.system.enable');
        return view('ChatModule_view::supporter', compact('value'));
    }
}
