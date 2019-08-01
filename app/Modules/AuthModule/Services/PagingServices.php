<?php
namespace App\Modules\AuthModule\Services;

use App\Modules\AuthModule\Repository\SysUserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PagingServices
{

    private $userRepository;

    public function __construct(SysUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function getUserList() : Collection{
        $userList = $this->userRepository->getUserList();
        return collect($userList);
    }
}