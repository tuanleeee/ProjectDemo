<?php
namespace App\Modules\AuthModule\Repository;

use App\Modules\AuthModule\Model\SysUser;
use Illuminate\Support\Collection;
use App\Exceptions\NoUserFoundException;

class SysUserRepository{
    public function save($user,$data){
        if ($data['password']!=null)
            $data['password']=bcrypt($data['password']);
        $collection = collect($data);
        $collection = $collection->filter();
        $user->fill($collection->all());
        
        $user->save();
    }

    public function newUser(){
    	$user = new SysUser(['first_name' => "",
			  'middle_name' =>"",
			  'last_name' => "",
			  'date_of_birth' => "2018-08-08",
			  'phone' => "123456789",
			  'address' => "",
              'image' => "noImage.jpeg"]);
    	return $user;
    }
    
    public function getUser($id){
        $user = SysUser::find($id);
        if (!$user){
            throw new NoUserFoundException();
        }
        return $user;
    }

    public function getUserList(){
        return SysUser::paginate(1);
    }
}
