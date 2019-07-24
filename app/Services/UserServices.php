<?php
namespace App\Services;

use App\User;
use App\Exceptions\FailLoginException;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Cache;
use Illuminate\Support\Facades\Auth;

class UserServices{
    private $userRepository; 
    
    public function  __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function create_user(array $data,$img_path){
        $user = $this->userRepository->newUser();
	    $data['password']=bcrypt($data['password']);
        $this->userRepository->save($user,$data);
    }

    public function login($request){
        $credentials = request(['username', 'password']);
        if(!Auth::attempt($credentials))
            throw new FailLoginException();
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        
        $expireAt = Carbon::now()->addMinutes(1);
        Cache::put('user-is-online-' . Auth::user()->id,true,$expireAt);
        
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
}
