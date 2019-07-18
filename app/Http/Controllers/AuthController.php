<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\User;

class AuthController extends Controller
{
    public function signup(SignUpRequest $request)
    {
        if ($request->user()->role!='admin'){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401); 
        }
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'state' => 'offline',
            'role' => 'supporter',
            'password' => bcrypt($request->password)
        ]);
        $user->save();
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
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
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

        return response()->json(User::all());
    }
}
