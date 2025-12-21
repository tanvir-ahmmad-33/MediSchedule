<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Services\AppointmentService;
use App\Services\AppointmentTypeService;
use App\Services\ClinicService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class DoctorAppointmentController extends Controller
{
    protected $clinicService, $appointmentTypeService, $userService, $appointmentService;

    public function __construct()
    {
        $this->clinicService          = new ClinicService();
        $this->appointmentTypeService = new AppointmentTypeService();
        $this->userService            = new UserService();
        $this->appointmentService     = new AppointmentService();
    }

    public function doctorInfo() {
        $user = Auth::user();

        return [
            'name'   => $user->name,
            'email'  => $user->email,
            'phone'  => $user->phone,
            'gender' => $user->gender
        ];
    }

    public function index(Request $request) {
        $search = $request->input('search');

        if($search) {
            $appointments = $this->appointmentService->getAllAppointments($search, 10);
        } else {
            $appointments = $this->appointmentService->getAllAppointments('', 10);
        }

        $doctor = $this->doctorInfo();

        if($request->ajax()) {
            return response()->json([
                'htmlContent' => view('doctor.appointment.data.index-appointment-data', compact('appointments'))->render(),
                'pagination'  => $appointments->appends(['search' => $search])->links('pagination::bootstrap-5')->render()
            ]);
        }
        
        return view('doctor.appointment.index', [
            'title'   => 'Doctor | Appointments',
            'doctor'  => $doctor,
            'appointments' => $appointments
        ]);
    }

    public function create() {
        $doctor = $this->doctorInfo();
        $clinics = $this->clinicService->getAllClinic();
        $appointmentTypes = $this->appointmentTypeService->getAppointmentTypes();
        

        return view('doctor.appointment.create', [
            'title'  => 'Doctor | Create Appointments',
            'doctor' => $doctor,
            'clinics' => $clinics,
            'appointmentTypes' => $appointmentTypes
        ]);
    }

    public function store(AppointmentRequest $request) {
        $validatedData = $request->getAppointments();

        $userExists = $this->userService->duplicateUserCheck($validatedData['email']);
        
        if($userExists) {
            $validatedData['user_id'] = $userExists->id;
        } else {
            $validatedData['role'] = 'patient';
            $user = $this->userService->createUser($validatedData);

            if(!$user) {
                return response()->json([
                    'status'      => false,
                    'user_create' => false,
                    'message'     => "Patient Id isn't created. Please create a Patient Id before making an appointment."
                ]);
            } else {
                $validatedData['user_id'] = $user->id;
            }
        }

        $appointmentCheck = $this->appointmentService->checkDuplicateAppointment($validatedData);

        if($appointmentCheck) {
            return response()->json([
                'status'      => false,
                'user_create' => $userExists ? true : false,
                'message'     => "This appointment already exists. Please choose a different time, clinic, or date."
            ]);
        } else {
            $appointment = $this->appointmentService->createAppointment($validatedData);

            if($appointment) {
                return response()->json([
                    'status'      => true,
                    'user_create' => $userExists ? true : false,
                    'message'     => "Appointment successfully created."
                ]);
            } else {
                return response()->json([
                    'status'      => false,
                    'user_create' => $userExists ? true : false,
                    'message'     => "Failed to create the appointment. Please try again."
                ]);
            }
        }
    }

    public function patientDetails($id) {
        $patient = $this->userService->getUserById($id);

        if($patient) {
            $response = [
                'status'  => true,
                'message' => "User data successfully fetched",
                'patient' => $patient
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "User data doesn't found"
            ];
        }

        return response()->json($response);
    }

    public function updateStatus(Request $request, $id) {
        $status = $this->appointmentService->changeAppointmentStatus($request->status, $id);

        if($status) {
            return response()->json([
                'status' => true,
                'message' => 'Appointment status changed succesfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Appointment status doesn't changed"
            ]);
        }
    }

    public function show($id) {
        $appointment = $this->appointmentService->getAppointmentById($id);

        if($appointment) {
            return response()->json([
                'status'      => true,
                'message'     => 'The appointment has been successfully retrieved',
                'appointment' => $appointment
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => "We couldn't find an appointment"
            ]);
        }
    }

    public function pending(Request $request) {
        $search = $request->input('search');

        if($search) {
            $appointments = $this->appointmentService->getPendingAppointments($search, 10);
        } else {
            $appointments = $this->appointmentService->getPendingAppointments('', 10);
        }

        $doctor = $this->doctorInfo();
        
        if($request->ajax()) {
            return response()->json([
                'htmlContent' => view('doctor.appointment.data.pending-appointment-data', compact('appointments'))->render(),
                'pagination'  => $appointments->appends(['search' => $search])->links('pagination::bootstrap-5')->render()
            ]);
        }

        return view('doctor.appointment.pending', [
            'title'        => 'Doctor | Pending Appointments',
            'doctor'       => $doctor,
            'appointments' => $appointments
        ]);
    }

    public function existed() {
        $doctor = $this->doctorInfo();
        $users  = $this->userService->getAllUser();
        $clinics = $this->clinicService->getAllClinic();
        $appointmentTypes = $this->appointmentTypeService->getAppointmentTypes();
        

        return view('doctor.appointment.exists', [
            'title'            => 'Doctor | Create Past Patient Appointments',
            'doctor'           => $doctor,
            'users'            => $users,
            'clinics'          => $clinics,
            'appointmentTypes' => $appointmentTypes
        ]);
    }

    public function existedStore($id) {
        
    }
}
