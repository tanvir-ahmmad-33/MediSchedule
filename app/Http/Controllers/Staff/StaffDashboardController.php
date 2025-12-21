<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffDashboardController extends Controller
{
    public function staffInfo() {
        $staff = Auth::user();

        return [
            'name' => $staff->name,
            'gender' => $staff->gender
        ];
    }
    public function index() {
        $staff = $this->staffInfo();
        return view('staff.dashboard', [
            'title' => 'Staff | Dashboard',
            'staff' => $staff
        ]);
    }
}
