<?php
namespace App\Modules\AuthModule\Repository;

use App\Modules\AuthModule\Model\SysUser;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Exceptions\NoUserFoundException;
use App\Exceptions\DatabaseErrorException;

class SysUserRepository{
    public function save($data){
        if ($data['password']!=null)
            $data['password']=bcrypt($data['password']);
        $collection = collect($data);
        $collection = $collection->filter();
        $user = new SysUser();
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
    //Delete this pls :)
    public function getUserList() : LengthAwarePaginator{
        return SysUser::paginate(1);
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
