<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\User;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        /*if ($request->user()->role!='admin'){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401); 
        }*/
        
        $image_path = $request->image->store('uploads','public');
        //dd($image_path);
        $user = new User([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'username' => $request->username,
            'image' => "storage/".$image_path,
            'user_role' => $request->user_role, 
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
        $credentials = request(['username', 'password']);
        
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
        if (Storage::disk('public')->exists($request->user()->image)){
            $content = Storage::disk('public')->get($request->user()->image);
        }
        return response()->json($request->user());
    }
}
