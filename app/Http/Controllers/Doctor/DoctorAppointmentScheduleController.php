<?php

namespace App\Http\Controllers\Doctor;

use Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\AppointmentScheduleService;
use App\Http\Requests\AppointmentScheduleRequest;

class DoctorAppointmentScheduleController extends Controller
{
    protected $appointmentScheduleService;

    public function __construct() {
        $this->appointmentScheduleService = new AppointmentScheduleService(); 
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

    public function index(Request $request) {
        $doctor               = $this->doctorInfo();
        $searchValue          = $request['searchValue'];
        $searchField          = $request['searchCategory'];

        $appointmentSchedules = $this->appointmentScheduleService->getAllAppointmentSchedule($searchValue, $searchField, 10);

        if(request()->ajax()) {
            return response()->json([
                'tableContent' => view('doctor.appointment-schedule.appointment-schedule-table-data', compact('appointmentSchedules'))->render(),
                'pagination'   => $appointmentSchedules
                                ->appends(['search-value'    => $searchValue, 'search-category' => $searchField])
                                ->links('pagination::bootstrap-5')->render()]);
        }

        return view('doctor.appointment-schedule.index', [
            'doctor'               => $doctor,
            'title'                => 'Doctor | Appointment Schedule',
            'appointmentSchedules' => $appointmentSchedules
        ]);
    }

    public function store() {}

    public function show($id) {
        $appointmentSchedule = $this->appointmentScheduleService->getAppointmentScheduleById($id);

        if($appointmentSchedule) {
            $appointmentSchedule['opening_time'] = Carbon::parse($appointmentSchedule['closing_time'])->format('h:i A');
            $appointmentSchedule['closing_time'] = Carbon::parse($appointmentSchedule['closing_time'])->format('h:i A');

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

    public function update(AppointmentScheduleRequest $request) {
        dd($request->all());
    }
    public function destroy() {}
}
