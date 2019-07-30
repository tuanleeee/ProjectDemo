<?php
namespace App\Services;

use App\User;
use App\Exceptions\FailLoginException;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Cache;
use Illuminate\Support\Facades\Auth;

class AdminServices{
    private $userRepository; 
    
    public function  __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getUser($id){
        $user = $this->userRepository->getUser($id);
        return $user;
    }

    public function changeUserInfo($id,$data){
        $id= $data['id'];
        $user = $this->userRepository->getUser($id);
        $this->userRepository->save($user,$data);
    }
}