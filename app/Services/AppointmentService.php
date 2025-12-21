<?php
namespace App\Services;

use App\Models\Appointment;
use App\Models\AppointmentSchedule;
use PhpParser\Node\Stmt\Return_;

class AppointmentService {
    public function checkDuplicateAppointment($data) {
        return Appointment::where('appointment_types_id', $data['appointment_types_id'])
                        ->where('clinics_id', $data['clinics_id'])
                        ->where('appointment_schedules_id', $data['appointment_schedules_id'])
                        ->exists();
    }

    public function createAppointment($data) {
        $appointmentSchedule = AppointmentSchedule::where('id', $data['appointment_schedules_id'])->first();

        if (!$appointmentSchedule || $appointmentSchedule->patient_capacity <= $appointmentSchedule->patient_appointed) {
            return false;
        }

        $createAppointmentData = [
            'user_id' => $data['user_id'],
            'age' => $data['age'],
            'address' => $data['address'],
            'city' => $data['city'],
            'appointment_types_id' => $data['appointment_types_id'],
            'clinics_id' => $data['clinics_id'],
            'appointment_schedules_id' => $data['appointment_schedules_id'],
            'description' => isset($data['description']) ? $data['description'] : null,
            'status' => 'pending'
        ];

        $appointment = Appointment::create($createAppointmentData);

        if($appointment) {
            $appointmentSchedule->patient_appointed += 1;
            $appointmentSchedule->save();
        }

        return $appointment;
    }

    public function getAllAppointments($search, $perPage) {
        return Appointment::search($search)->paginate($perPage);
    }

    public function changeAppointmentStatus($status, $id) {
        $appointment = Appointment::find($id);

        if($appointment) {
            $appointment->status = $status;
            $appointment->save();

            return true;
        }

        return false;
    }

    public function getAppointmentById($id) {
        return Appointment::with(['user', 'appointmentType', 'clinic', 'appointmentSchedule'])->find($id);
    }

    public function getPendingAppointments($search, $perPage) {
        return Appointment::search($search)->where('status', 'pending')->paginate($perPage);
    }

    public function getAllAppointmentById($id) {
        return Appointment::where('user_id', $id)->orderBy('created_at', 'asc')->get();
    }
}