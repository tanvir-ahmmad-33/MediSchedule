<?php

namespace App\Services;

use App\Models\User;

class UserService {
    public function duplicateUserCheck($email) {
        return User::where('email',$email)->first();
    }

    public function createUser($data) {
        $userCreateData = [
            'name'           => $data['first_name'] . ' ' . $data['last_name'],
            'phone'          => $data['phone'],
            'email'          => $data['email'],
            'role'           => $data['role'],
            'gender'         => $data['gender'],
            'admin_verified' => false,
            'password'       => $data['password']
        ];

        return User::create($userCreateData);
    }
}