<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Exceptions\UnauthorizedException;
use App\Services\ImgServices;
use App\Services\UserServices;
use App\User;

class AuthController extends Controller
{
    private $imgServices;
    private $userServices;
    public function __construct(ImgServices $imgServices,UserServices $userServices){
        $this->imgServices = $imgServices;
        $this->userServices = $userServices;
    }

    public function signup(Request $request)
    {
        /*if ($request->user()->role!='admin'){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401); 
        }*/

        $image_name=$request->username.'_'.time();

        $this->imgServices->save_img($request->image,$image_name,"avatar",60,80);
        
        $this->userServices->create_user($request->all(),$image_name);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    /**
     * Login user and create token
     *
     */
    public function login(LoginRequest $request)
    {
        //this one for service level
        $credentials = request(['username', 'password']);
        
        if(!Auth::attempt($credentials))
            throw new UnauthorizedException();
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
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
  
    /**
     * Logout user (Revoke the token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     */
    public function user(Request $request)
    {
        /*if (Storage::disk('public')->exists($request->user()->image)){
            $content = Storage::disk('public')->get($request->user()->image);
        }*/
        return response()->json($request->user());
    }
}
