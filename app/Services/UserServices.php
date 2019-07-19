<?php
namespace App\Services;

use App\User;

class UserServices{
    public function create_user(array $data,$img_path){
        $user = new User([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'username' => $data['username'],
            'image' => $img_path,
            'user_role' => $data['user_role'], 
            'password' => bcrypt($data['password'])
        ]);
        $user->save();
    }
}