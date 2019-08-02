<?php
namespace App\Modules\AuthModule\Repository;

use App\Modules\AuthModule\Model\SysUser;
use Illuminate\Support\Collection;
use App\Exceptions\NoUserFoundException;
use App\Exceptions\DatabaseErrorException;

class SysUserRepository{
    public function save(array $data,SysUser $user){
        if (array_key_exists('password',$data))
            $data['password']=bcrypt($data['password']);
        $collection = collect($data);
        $collection = $collection->filter();
        $user->fill($collection->all());
        if (!$user->save()){
            throw new DatabaseErrorException();
        }
    }

    
    public function getUser($id) : SysUser{
        $user = SysUser::find($id);
        if (!$user){
            throw new NoUserFoundException();
        }
        return $user;
    }

    //Get support list and status

    public function getSupporterList() : Collection{
        $users = \App\Modules\AuthModule\Model\sysUser::all();
        $userList = collect();
        foreach($users as $user){
            if ($user->isOnline()) $userList->push([$user,'online']);
            else $userList->push([$user,'offline']);
        }
        return $userList;
    }
}
