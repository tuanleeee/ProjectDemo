<?php

namespace App\Modules\AuthModule\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Http\Controllers\Controller;
use App\Modules\AuthModule\Model\SysUser;

use App\Modules\AuthModule\Services\ResponseForm;
use App\Modules\AuthModule\Services\PagingServices;
use App\Modules\AuthModule\Services\UserServices;
use App\Modules\AuthModule\Services\ImgServices;

use App\Modules\AuthModule\Requests\LoginRequest;
use App\Modules\AuthModule\Requests\SignUpRequests;

use App\Modules\AuthModule\Exceptions\NotExistedTokenException;

use Cache;
use vendor\laravel\passport\src;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    private $pagingServices; //PagingServices
    private $imgServices;   //ImageServices
    private $userServices; //UserServices

    public function __construct(PagingServices $pagingServices,
                                ImgServices $imgServices,
                                UserServices $userServices){
        $this->pagingServices = $pagingServices;
        $this->imgServices = $imgServices;
        $this->userServices = $userServices;
    }



    public function getUser(Int $id): JsonResponse{
        $user=$this->userServices->getUser($id);
        $response = new ResponseForm();
        $response->addData($user);
        return $response->getResponse();
    }



    public function changeInfo(Request $request){
        $user = $this->userServices->changeUserInfo($request->all());
    }



    public function signup(SignUpRequests $request) : JsonResponse
    {

        $image_name=$request->username.'_'.time();

        $this->userServices->create_user($request->all(),$image_name);

        $this->imgServices->save_img($request->image,$image_name);

        $response = new ResponseForm();

        return $response->getResponse();
    }
  


    public function login(LoginRequest $request) : JsonResponse
    {
        $token = $this->userServices->login($request);

        $response = new ResponseForm();

        $response->addData($token);

        return $response->getResponse();
    }
  


    public function logout(Request $request) : JsonResponse
    {
        $this->userServices->logout($request);

        $response = new ResponseForm();
        return $response->getResponse();
    }


  
    public function user(Request $request) : JsonResponse
    {
        $reponse = new ResponseForm();

        return $response->getResponse();
    }



    public function getSupporterList(Request $request): JsonResponse
    {

        $response = new ResponseForm();
        $response->addData(
            collect(
                $this->userServices->getSupporterList($request->url())
            )
        );

        return $response->getResponse();
    }
}
