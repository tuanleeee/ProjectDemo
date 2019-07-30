<?php
namespace App\Modules\AuthModule\Services;

use Illuminate\Http\JsonResponse;
use App\Modules\AuthModule\Model\SysUser;
use App\Modules\AuthModule\Repository\SysUserRepository;
use App\Modules\AuthModule\Exceptions\FailLoginException;

use Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserServices{
    private $userRepository; 
    
    public function  __construct(SysUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function create_user(array $data,$img_path){
        $user = $this->userRepository->newUser();
        $this->userRepository->save($user,$data);
    }

    /**
     * Methods use by login
     * 
     */

    private function setOnline(SysUser $user){
        $expireAt = Carbon::now()->addMinutes(1);
        Cache::put('user-is-online-' . Auth::user()->id,true,$expireAt);
    }

    public function login($request) : JsonResponse{
        $credentials = request(['username', 'password']);
        if(!Auth::attempt($credentials))
            throw new FailLoginException();
        $user = $request->user();
        $tokenResult = $user->createToken('Secret key');
        $token = $tokenResult->token;
        
        $this->setOnline($user);

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json(["data"=>[
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()],"msg"=>"successful","status"=>200
        ]);
    }

    public function logout($request){
        $request->user()->token()->revoke();
        Cache::pull('user-is-online-' . Auth::user()->id);
        return response()->json([
            'message' => 'Successfully logged out'
        ]); 
    }
}
