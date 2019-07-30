<?php
namespace App\Modules\AuthModule\Services;

use App\Modules\AuthModule\Model\SysUser;
use App\Exceptions\FailLoginException;
use App\Modules\AuthModule\Repository\SysUserRepository;
use Carbon\Carbon;
use Cache;
use Illuminate\Support\Facades\Auth;

class AdminServices{
    private $userRepository; 
    
    public function  __construct(SySUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getUser(Int $id): SysUser{
        $user = $this->userRepository->getUser($id);
        return $user;
    }

    public function changeUserInfo($data){
        $data['user_role'] = null;
        $data['username'] = null;
        $id = $data['id'];
        $user = $this->userRepository->getUser($id);
        $this->userRepository->save($user,$data);
    }
}