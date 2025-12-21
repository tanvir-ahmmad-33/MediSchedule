<?php
namespace App\Services;

use App\Models\Staff;
use App\Models\User;

class StaffService {
    public function getAllPaginatedStaff($search, $perPage) {
        return Staff::search($search)->paginate($perPage);
    }

    public function createStaff($data) {
        $imagePath = null;
        if(isset($data['profile_image']) && $data['profile_image']->isValid()) {
            $ext = $data['profile_image']->getClientOriginalExtension();
            $imageName = $data['user_id'] . '-' . now()->format('YmdHis') . '-' . $ext;
            $imagePath = $data['profile_image']->storeAs('staff_images', $imageName, 'public');
        }

        $createStaffData = [
            'user_id'           => $data['user_id'],
            'age'               => $data['age'],
            'working_section'   => $data['working_section'],
            'employment_status' => 'active',
            'image_path'        => $imagePath,	
            'experience'        => $data['experience'],
        ];

        $user = User::find($data['user_id']);
        if($user) {
            $user->admin_verified = true;
            $user->save();
        }

        return Staff::create($createStaffData);
    }

    public function numberOfStaff() {
        return Staff::count();
    }

    public function numberOfActiveStaff() {
        return Staff::where('employment_status', 'active')->count();
    }

    public function numberOfOnBreakStaff() {
        return Staff::where('employment_status', 'on_leave')->count();
    }

    public function numberOfSickedStaff() {
        return Staff::where('employment_status', 'sicked')->count();
    }

    public function numberOfRetiredStaff() {
        return Staff::where('employment_status', 'retired')->count();
    }

    public function numberOfSuspendedStaff() {
        return Staff::where('employment_status', 'suspended')->count();
    }

    public function changeStatusById($status, $id) {
        $staff = Staff::find($id);


        if($staff) {
            $staff->employment_status = $status;
            $staff->save();
            return true;
        }

        return false;
    }

    public function deleteStaffById($userId, $id) {
        $staff = Staff::find($id);
        $user  = User::find($userId);

        if($staff && $user) {
            $staff->delete();
            $user->delete();
            return true;
        }

        return false;
    }
}