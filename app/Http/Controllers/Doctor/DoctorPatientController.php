<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DoctorPatientController extends Controller
{
    protected $userService, $appointmentService;

    public function __construct()
    {
        $this->userService        = new UserService();
        $this->appointmentService = new AppointmentService();
    }

    public function doctorInfo() {
        $doctor = Auth::user();

        return [
            'name' => $doctor->name,
            'gender' => $doctor->gender,
        ];
    }

    public function index() {
        $doctor = $this->doctorInfo();
        $patients = $this->userService->getAllPaginatedPatient(10);

        return view('doctor.patient.index', [
            'title' => 'Doctor | Patient',
            'doctor' => $doctor,
            'patients' => $patients
        ]);
    }

    public function show($id) {
        $patient = $this->userService->getUserById($id);
        $appointments = $this->appointmentService->getAllAppointmentById($id);

        if($patient && $appointments) {
            $firstAppointmentDate  = $appointments->first() ? $appointments->first()->created_at : null;
            $latestAppointmentDate = $appointments->last() ? $appointments->last()->created_at : null;
            $patient['appointmentsNumber'] = $appointments->count();
            $firstAppointment      = $appointments->first();
            $patient['age']        = $firstAppointment ? $firstAppointment->age : null;

            $patient['firstAppointmentDateFormatted']  = $firstAppointmentDate ? Carbon::parse($firstAppointmentDate)->format('l, d M, Y') : null;
            $patient['latestAppointmentDateFormatted'] = $latestAppointmentDate ? Carbon::parse($latestAppointmentDate)->format('l, d M, Y') : null;

            $response = [
                'status'             => true,
                'message'            => "Patient & patient's appointments found successfully.",
                'patient'            => $patient
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Patient not found.'
            ];
        }

        return response()->json($response);
    }
}
