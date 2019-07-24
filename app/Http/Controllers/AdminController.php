<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminServices;

class AdminController extends Controller
{
    private $adminServices;

    public function __construct(AdminServices $adminServices){
        $this->adminServices = $adminServices;
    }

    public function getUser($id){
        $user=$this->adminServices->getUser($id);
        return $user;
    }
}
