<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Services\ClinicService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DoctorClinicController extends Controller
{
    protected $clinicService;

    public function __construct() {
        $this->clinicService = new ClinicService();
    }
    public function doctorInfo() {
        $doctor = Auth::user();
        
        return [
            'name' => $doctor->name,
            'email' => $doctor->email,
            'phone' => $doctor->phone,
            'gender' => $doctor->gender
        ];
    }

    public function index() {
        $doctor  = $this->doctorInfo();
        $clinics = $this->clinicService->getAllClinic();
        
        return view('doctor.clinic.index', [
            'title'   => 'Doctor | Healthcare Facilities Details',
            'doctor'  => $doctor,
            'clinics' => $clinics
        ]);
    }

    public function create() {
        $doctor = $this->doctorInfo();
        
        return view('doctor.clinic.create', [
            'title' => 'Doctor | Create Healthcare Facility',
            'doctor' => $doctor
        ]);
    }

    public function store(ClinicRequest $request) {
        $validatedData = $request->getClinic();

        $clinic = $this->clinicService->createClinic($validatedData);

        if($clinic) {
            $response = [
                'status'  => true,
                'message' => 'Clinic has been created succesfully.'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "Clinic hasn't been created."
            ];
        }

        return response()->json($response);
    }

    public function show($id) {
        $clinic = $this->clinicService->getClinicById($id);

        if($clinic) {
            $response = [
                'status'  => true,
                'message' => 'Clinic details retrieved successfully.',
                'clinic'  => $clinic
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "Clinic details isn't found."
            ];
        }

        return response()->json($response);
    }

    public function edit($id) {
        $clinic = $this->clinicService->getClinicById($id);

        if($clinic) {
            $response = [
                'status'  => true,
                'message' => 'Clinic details retrieved successfully.',
                'clinic'  => $clinic,
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "Clinic details isn't found."
            ];
        }

        return response()->json($response);
    }

    public function update(ClinicRequest $request, $id) {
        $validatedData = $request->getClinic();

        $clinic = $this->clinicService->updateClinic($validatedData, $id);

        if($clinic) {
            $response = [
                'status'  => true,
                'message' => 'Clinic has been updated succesfully.'
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "Clinic hasn't been updated."
            ];
        }

        return response()->json($response);
    }

    public function destroy($id) {
        $clinic = $this->clinicService->deleteClinic($id);

        if($clinic) {
            $response = [
                'status'  => true,
                'message' => "Healthcare Facility is removed successfully."
            ];
        } else {
            $response = [
                'status'  => false,
                'message' => "Healthcare Facility isn't removed successfully."
            ];
        }

        return response()->json($response);
    }

    public function getAllClinics() {
        $clinics = $this->clinicService->getAllClinic();

        if($clinics) {
            return response()->json([
                'status'       => true,
                'tableContent' => view('doctor.clinic.modal.all-clinics-edit-card-modal', compact('clinics'))->render()
            ]);
        } else {
            return response()->json([
                'status'       => false,
                'message'      => 'No clinics found.'
            ]);
        }
    }
}
