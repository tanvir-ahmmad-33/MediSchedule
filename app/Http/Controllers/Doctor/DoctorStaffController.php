<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Services\StaffService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorStaffController extends Controller
{
    protected $userService, $staffService;

    public function __construct() {
        $this->userService = new UserService();
        $this->staffService = new StaffService();
    }

    public function doctorInfo() {
        $user = Auth::user();

        return [
            'name' => $user->name,
            'gender' => $user->gender
        ];
    }

    public function index(Request $request) {
        $search = $request->input('search', 'all');
        $doctor       = $this->doctorInfo();

        $staffs = $this->staffService->getAllPaginatedStaff($search, 5);

        $staffNumber  = $this->staffService->numberOfStaff();
        $activeStaffNumber = $this->staffService->numberOfActiveStaff();
        $onLeaveStaffNumber = $this->staffService->numberOfOnBreakStaff();
        $sickStaffNumber = $this->staffService->numberOfSickedStaff();

        $pendingStaff = $this->userService->pendingStaffNumber();

        if($request->ajax()) {
            return response()->json([
                'htmlContent' => view('doctor.staff.data.staff-data', compact('staffs'))->render(),
                'pagination'  => $staffs->appends(['search' => $search])->links('pagination::bootstrap-5')->render()
            ]);
        }

        return view('doctor.staff.index', [
            'title'              => 'Doctor | Staff',
            'doctor'             => $doctor,
            'staffs'             => $staffs,
            'pendingStaff'       => $pendingStaff,
            'staffNumber'        => $staffNumber,
            'activeStaffNumber'  => $activeStaffNumber,
            'onLeaveStaffNumber' => $onLeaveStaffNumber,
            'sickStaffNumber'    => $sickStaffNumber
        ]);
    }

    public function show($id) {
        $staff = $this->userService->getStaffById($id);

        if($staff) {
            $response = [
                'status'  => true,
                'message' => 'Staff found successfully'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Staff not found'
            ];
        }

        return response()->json($response);
    }

    public function create() {
        $doctor = $this->doctorInfo();

        return view('doctor.staff.create', [
            'title'  => 'Doctor | Create Staff',
            'doctor' => $doctor,
        ]);
    }

    public function store(StaffRequest $request) {
        $validateData = $request->getStaff();
        $existedUser = $this->userService->duplicateUserCheck($validateData['email']);

        if(!$existedUser) {
            $user = $this->userService->createUser($validateData);
            $validateData['user_id'] = $user['id'];
        } else {
            return response()->json([
                'user_create' => false,
                'status' => false,
                'message' => "User already exists. Staff creation failed."
            ]);
        }

        $staff = $this->staffService->createStaff($validateData);
        if($staff) {
            return response()->json([
                'user_create' => true,
                'status' => true,
                'message' => "Staff has been created successfully"
            ]);
        } else {
            return response()->json([
                'user_create' => true,
                'status' => false,
                'message' => "Staff creation failed. Please try again."
            ]);
        }
    }


    public function pending() {
        $doctor = $this->doctorInfo();
        $pendingStaffs = $this->userService->getAllPendingStaff();

        return view('doctor.staff.pending', [
            'title'         => 'Doctor | Pending Staff',
            'doctor'        => $doctor,
            'pendingStaffs' => $pendingStaffs
        ]);
    }

    public function edit($id) {
        $staff = $this->userService->getStaffById($id);

        if($staff) {
            $response = [
                'status'  => true,
                'message' => 'Staff data retrieved successfully.',
                'staff'   => $staff
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Staff member not found.',
            ];
        }

        return response()->json($response);
    }

    public function changeStatus(Request $request, $id) {
        $status = $request->status;
        $changeStatus = $this->staffService->changeStatusById($status, $id);

        if($changeStatus) {
            $response = [
                'status'  => true,
                'message' => 'Status has been changed successfully'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "Status hasn't changed"
            ];
        }

        return response()->json($response);
    }

    public function approve(StaffRequest $request, $id) {
        $validateData = $request->getStaff();
        $user = $this->userService->getStaffById($id);

        if(!$user) {
            return response()->json([
                'status' => false,
                'message' => "User doesn't exists."
            ]);
        } else {
            $validateData['user_id'] = $user['id'];
        }

        $staff = $this->staffService->createStaff($validateData);

        if($staff) {
            return response()->json([
                'status' => true,
                'message' => "Staff has been approved successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Staff approval failed."
            ]);
        }
    }

    public function approvalDestroy($id) {
        $deleteStaff = $this->userService->deleteUser($id);

        if($deleteStaff) {
            $response = [
                'status'  => true,
                'message' => 'Staff approval has been deleted successfully'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "Staff approval hasn't been deleted"
            ];
        }

        return response()->json($response);
    }

    public function destroy(Request $request, $id) {
        $userId = $request->userId;

        $deleteStaff = $this->staffService->deleteStaffById($userId, $id);

        if($deleteStaff) {
            $response = [
                'status'  => true,
                'message' => 'Staff has been deleted successfully'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "Staff hasn't deleted."
            ];
        }

        return response()->json($response);
    }
}
