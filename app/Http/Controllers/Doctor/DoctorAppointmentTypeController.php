<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentTypeRequest;
use App\Services\AppointmentTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorAppointmentTypeController extends Controller
{
    protected $appointmentTypeService;

    public function __construct() {
        $this->appointmentTypeService = new AppointmentTypeService();
    }

    public function doctorInfo() {
        $doctor = Auth::user();

        return [
            'name'   => $doctor->name,
            'email'  => $doctor->email,
            'phone'  => $doctor->phone,
            'gender' => $doctor->gender,
        ];
    }

    public function index(Request $request) {
        $doctor = $this->doctorInfo();
        $search = $request->input('search', '');
        $appointmentTypes = $this->appointmentTypeService->getAllAppointmentType($search, 10);

        if(request()->ajax()) {
            return response()->json([
                'tableContent' => view('doctor.appointment-type.appointment-type-table-data', compact('appointmentTypes'))->render(),
                'pagination'   => $appointmentTypes->appends(['search' => $search])->links('pagination::bootstrap-5')->render(),
            ]);
        }

        return view('doctor.appointment-type.index', [
            'title'           => 'Doctor | Appointment Type',
            'doctor'          => $doctor,
            'appointmentTypes' => $appointmentTypes
        ]);
    }

    public function store(AppointmentTypeRequest $request) {
        $validatedData = $request->getAppointmentType();

        $appointmentType = $this->appointmentTypeService->createAppointmentType($validatedData);

        if($appointmentType) {
            $response = [
                'status'  => true,
                'message' => 'Appointment type created successfully!'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Failed to create appointment type. Please try again.'
            ];
        }

        return response()->json($response);
    }

    public function edit($id) {
        $appointmentType = $this->appointmentTypeService->getAppointmentTypeById($id);

        if($appointmentType) {
            $response = [
                'status'          => true,
                'message'         => 'Appointment type found successfully.',
                'appointmentType' => $appointmentType
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Appointment type not found.'
            ];
        }

        return response()->json($response);
    }

    public function update(AppointmentTypeRequest $request, $id) {
        $validatedData = $request->getAppointmentType();

        $appointmentType = $this->appointmentTypeService->updateAppointmentType($validatedData, $id);

        if($appointmentType) {
            $response = [
                'status'  => true,
                'message' => 'Appointment type updated successfully!'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Failed to update appointment type. Please try again.'
            ];
        }

        return response()->json($response);
    }

    public function destroy($id) {
        $appointmentType = $this->appointmentTypeService->deleteAppointmentType($id);

        if($appointmentType) {
            $response = [
                'status'  => true,
                'message' => 'Appointment Type deleted successfully!'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => 'Failed to delete appointment type. Please try again.'
            ];
        }

        return response()->json($response);
    }
}
