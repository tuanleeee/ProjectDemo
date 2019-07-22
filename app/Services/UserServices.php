<?php
namespace App\Services;

use App\User;
use App\Exceptions\FailLoginException;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserServices{
    private $userRepository; 
    
    public function  __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function create_user(array $data,$img_path){
        $user = new User([
            'first_name' => "",
            'middle_name' => "",
            'last_name' => "",
            'date_of_birth' => "",
            'phone' => "",
            'email' => $data['email'],
            'address' => "",
            'username' => $data['username'],
            'image' => "noImage.jpeg", 
            'password' => bcrypt($data['password'])]);
            $this->userRepository->save($user,$data);
            /*'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'username' => $data['username'],
            'image' => $img_path,
            'user_role' => $data['user_role'], 
            'password' => bcrypt($data['password'])
        ]);
        $user->save();*/
    }

    public function login($request){
        $credentials = request(['username', 'password']);
        
        if(!Auth::attempt($credentials))
            throw new FailLoginException();
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
}