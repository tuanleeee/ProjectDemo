<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SupporterController extends Controller
{
    public function getOnlineList(){
        $users = \App\User::all();
        $online = collect();
        foreach($users as $user){
            if ($user->isOnline()) $online->push($user);
        }
        return $online;
    }
}
