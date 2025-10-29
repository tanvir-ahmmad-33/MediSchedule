<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DoctorDashboardController extends Controller
{
    public function doctorInfo() {
        $doctor = Auth::user();

        return [
            'name' => $doctor->name,
            'gender' => $doctor->gender,
        ];
    }

    public function index() {
        $doctor = $this->doctorInfo();
        return view('doctor.dashboard', ['title' => 'Doctor | Dashboard', 'doctor' => $doctor]);
    }
}
