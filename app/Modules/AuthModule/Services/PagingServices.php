<?php
namespace App\Modules\AuthModule\Services;

use App\Modules\AuthModule\Repository\SysUserRepository;

class PagingServices
{

    private $userRepository;

    public function __construct(SysUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getUserList():json{
        $userList = $this->userRepository->getUserList();
        return ["data"=>$userList,"msg"=>"successful","status"=>200];
    }
}