<?php

namespace App\Modules\AuthModule\Controller;


use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Modules\AuthModule\Model\SysUser;

use App\Modules\AuthModule\Services\AdminServices;
use App\Modules\AuthModule\Services\PagingServices;
use App\Modules\AuthModule\Services\UserServices;
use App\Modules\AuthModule\Services\ImgServices;

use App\Modules\AuthModule\Requests\LoginRequest;
use App\Modules\AuthModule\Requests\SignUpRequests;

use App\Modules\AuthModule\Exceptions\NotExistedTokenException;

use Cache;
use vendor\laravel\passport\src;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    private $adminServices; // AdminServices
    private $pagingServices; //PagingServices
    private $imgServices;   //ImageServices
    private $userServices; //UserServices

    public function __construct(AdminServices $adminServices,
                                PagingServices $pagingServices,
                                ImgServices $imgServices,
                                UserServices $userServices){
        $this->adminServices = $adminServices;
        $this->pagingServices = $pagingServices;
        $this->imgServices = $imgServices;
        $this->userServices = $userServices;
    }

    public function getUser(Int $id): SysUser{
        $user=$this->adminServices->getUser($id);
        return $user;
    }

    public function changeInfo(Request $request){
        $user = $this->adminServices->changeUserInfo($request->all());
    }

    public function getUserList(): array{
        return $this->pagingServices->getUserList();
    }

    public function signup(SignUpRequests $request){
        //dd("fuck");

        $image_name=$request->username.'_'.time();

        $this->userServices->create_user($request->all(),$image_name);

        $this->imgServices->save_img($request->image,$image_name);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    public function login(LoginRequest $request) : JsonResponse{
        $message = $this->userServices->login($request);
        return $message;
    }
  
    public function logout(Request $request): json{
        $message = $this->userServices->logout($request);
        return $message;
    }
  
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function getOnlineList(): array{
        $users = \App\User::all();
        $online = collect();
        foreach($users as $user){
            if ($user->isOnline()) $online->push($user);
        }
        return $online;
    }
}
