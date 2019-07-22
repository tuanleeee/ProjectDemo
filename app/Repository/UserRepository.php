<?php
namespace App\Repository;

use App\User;
use Illuminate\Support\Collection;

class UserRepository{
    public function save($user,$data){
        $collection = collect($data);
        $collection = $collection->filter();
        $user->fill($collection->all());
        
        $user->save();
    }
}