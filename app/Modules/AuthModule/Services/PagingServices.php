<?php
namespace App\Modules\AuthModule\Services;

use App\Modules\AuthModule\Repository\SysUserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PagingServices
{

    private $userRepository;

    public function __construct(SysUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getUserList() : LengthAwarePaginator{
        $userList = $this->userRepository->getUserList();
        return $userList;
    }
}