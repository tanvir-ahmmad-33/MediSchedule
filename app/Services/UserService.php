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

    public function getStaffById($id) {
        return User::find($id);
    }

    public function pendingStaffNumber() {
        return User::where('role', 'staff')
                ->where('admin_verified', 0)
                ->count();
    }

    public function getAllPendingStaff() {
        return User::where('admin_verified', 0)
               ->where('role', 'staff')
               ->get();
    }

    public function deleteUser($id) {
        $user = User::find($id);

        if($user) {
            $user->delete();
            return true;
        }

        return false;
    }

    public function getAllPaginatedPatient($perPage) {
        return User::where('role', 'patient')->paginate($perPage);
    }

    public function getUserById($id) {
        return User::find($id);
    }

    public function getAllUser() {
        return User::all();
    }
}