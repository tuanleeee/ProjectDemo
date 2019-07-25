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
    public function newUser(){
    	$user = new User(['first_name' => "",
			  'middle_name' =>"",
			  'last_name' => "",
			  'date_of_birth' => "2018-08-08",
			  'phone' => "123456789",
			  'address' => "",
		          'image' => "noImage.jpeg"]);
    	return $user;
    }    
}
