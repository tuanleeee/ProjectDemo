<?php
namespace App\Services;

use App\Repository\UserRepository;

class PagingServices
{

    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getUserList(){
        $userList = $this->userRepository->getUserList();
        return ["data"=>$userList,"msg"=>"successful","status"=>200];
    }
}