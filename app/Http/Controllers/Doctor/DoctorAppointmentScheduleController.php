<?php

namespace App\Http\Controllers\Doctor;

use Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\AppointmentScheduleService;
use App\Http\Requests\AppointmentScheduleRequest;
use App\Services\ClinicService;

class DoctorAppointmentScheduleController extends Controller
{
    protected $appointmentScheduleService, $clinicService;

    public function __construct() {
        $this->appointmentScheduleService = new AppointmentScheduleService(); 
        $this->clinicService              = new ClinicService();
    }

    public function doctorInfo() {
        $doctor = Auth::user();

        return [
            'name'   => $doctor->name,
            'phone'  => $doctor->phone,
            'email'  => $doctor->email,
            'gender' => $doctor->gender,
        ];
    }

    public function create() {
        $doctor  = $this->doctorInfo();
        $clinics = $this->clinicService->getAllClinic();
        return view('doctor.appointment-schedule.create', [
            'title'   => 'Doctor',
            'doctor'  => $doctor,
            'clinics' => $clinics
        ]);
    }

    public function store(AppointmentScheduleRequest $request) {
        $validatedData = $request->getAppointmentSchedule();
        $overlap = $this->appointmentScheduleService->appointmentScheduleOverlapCheck($validatedData);

        if($overlap) {
            $response = [
                'status'  => true,
                'overlap' => true,
                'message' => 'The selected time slot conflicts with an existing appointment schedule. Please choose a different time or date.'
            ];
        } else {
            $schedule = $this->appointmentScheduleService->createAppointmentSchedule($validatedData);

            if($schedule) {
                $response = [
                    'status' => true,
                    'overlap' => false,
                    'message' => 'Appointment schedule created successfully!'
                ];
            } else {
                $response = [
                    'status' => false,
                    'overlap' => false,
                    'message' => 'Failed to create the appointment schedule due to a server error.'
                ];
            }
        }

        return response()->json($response);
    }

    public function index(Request $request) {
        $searchValue = $request->input('schedule-search-value');
        $searchField = $request->input('schedule-search-category');

        if($searchField || $searchValue) {
            $appointmentSchedules = $this->appointmentScheduleService->getAllAppointmentSchedule($searchValue, $searchField, 10);
        } else {
             $appointmentSchedules = $this->appointmentScheduleService->getAllAppointmentSchedule('', '', 10);
        }

        $doctor = $this->doctorInfo();
       
        if($request->ajax()) {
            return response()->json([
                'htmlContent' => view('doctor.appointment-schedule.appointment-schedule-table-data', compact('appointmentSchedules'))->render(),
                'pagination' => $appointmentSchedules->appends([
                            'schedule-search-value' => $searchValue,
                            'schedule-search-category' => $searchField
                            ])->links('pagination::bootstrap-5')->render()
            ]);
        }

        return view('doctor.appointment-schedule.index', [
            'doctor'               => $doctor,
            'title'                => 'Doctor | Appointment Schedule',
            'appointmentSchedules' => $appointmentSchedules
        ]);
    }

    public function show($id) {
        $appointmentSchedule = $this->appointmentScheduleService->getAppointmentScheduleById($id);

        if($appointmentSchedule) {
            $appointmentSchedule['clinic']           = $this->clinicService->getClinicById($appointmentSchedule['clinic_id']);
            $appointmentSchedule['opening_time']     = Carbon::parse($appointmentSchedule['opening_time'])->format('h:i A');
            $appointmentSchedule['closing_time']     = Carbon::parse($appointmentSchedule['closing_time'])->format('h:i A');
            $appointmentSchedule['appointment_date'] = Carbon::parse($appointmentSchedule['appointment_date'])->format('d F, Y');
            $appointmentSchedule['weekday']          = Carbon::parse($appointmentSchedule['appointment_date'])->format('l');

            $response = [
                'status' => true,
                'message' => 'Appointment schedule found successfully.',
                'appointmentSchedule' => $appointmentSchedule
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Appointment schedule not found.'
            ];
        }

        return response()->json($response);
    }

    public function edit($id) {
        $appointmentSchedule = $this->appointmentScheduleService->getAppointmentScheduleById($id);

        if($appointmentSchedule) {
            $appointmentSchedule['clinics'] = $this->clinicService->getAllClinic();
            
            $response = [
                'status' => true,
                'message' => 'Appointment schedule found successfully.',
                'appointmentSchedule' => $appointmentSchedule
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Appointment schedule not found.'
            ];
        }

        return response()->json($response);
    }

    public function update(AppointmentScheduleRequest $request, $id) {
        $validatedData = $request->getAppointmentSchedule();
        
        $schedule = $this->appointmentScheduleService->updateAppointmentSchedule($validatedData, $id);

        if($schedule) {
            $response = [
                'status'  => true,
                'message' => 'Appointment schedule updated successfully.'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "Appointment schedule couldn't be updated."
            ];
        }

        return response()->json($response);
    }

    public function destroy($id) {
        $schedule = $this->appointmentScheduleService->deleteAppointmentSchedule($id);

        if($schedule) {
            $response = [
                'status'  => true,
                'message' => 'Appointment schedule deleted successfully.'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "Appointment schedule couldn't be deleted."
            ];
        }

        return response()->json($response);
    }

    public function getSchedule($id) {
        $schedules = $this->appointmentScheduleService->getAppointmentScheduleSelectingClinic($id);


        if($schedules) {
            $response = [
                'status'    => true,
                'message'   => 'Appointment schedules fetched successfully.',
                'schedules' => $schedules
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "Appointment schedules couldn't fetched."
            ];
        }

        return response()->json($response);
    }
}
