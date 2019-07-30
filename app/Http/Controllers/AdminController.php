<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminServices;
use App\Services\PagingServices;

class AdminController extends Controller
{
    private $adminServices,$pagingServices;

    public function __construct(AdminServices $adminServices,PagingServices $pagingServices){
        $this->adminServices = $adminServices;
        $this->pagingServices = $pagingServices;
    }

    public function getUser($id){
        $user=$this->adminServices->getUser($id);
        return $user;
    }

    public function changeInfo(Request $request){
        $user = $this->adminServices->changeUserInfo($request->all());
    }

    public function getUserList(){
        return $this->pagingServices->getUserList();
    }
}
