<?php
namespace App\Services;

use App\Models\AppointmentSchedule;

class AppointmentScheduleService {
    public function getAllAppointmentSchedule($searchValue, $searchField, $perPage) {
        return AppointmentSchedule::search($searchValue, $searchField)->paginate($perPage);
    }

    public function getAppointmentScheduleById($id) {
        return AppointmentSchedule::find($id);
    }

    public function appointmentScheduleOverlapCheck($data) {
        $date      = $data['appointment_date'];
        $startTime = $data['opening_time'];
        $endTime   = $data['closing_time'];

        return AppointmentSchedule::whereTimeOverlap($date, $startTime, $endTime)->exists();;
    }

    public function createAppointmentSchedule($data) {
        $createAppointmentScheduleData = [
            'clinic_id'        => $data['clinic_id'],
            'appointment_date' => $data['appointment_date'],
            'opening_time'     => $data['opening_time'],
            'closing_time'     => $data['closing_time'],
            'patient_capacity' => $data['patient_capacity'],
            'ot_status'        => $data['ot_status'],
        ];

        return AppointmentSchedule::create($createAppointmentScheduleData);
    }

    public function updateAppointmentSchedule($data, $id) {
        $schedule = AppointmentSchedule::find($id);

        if($schedule) {
            return $schedule->update([
                'clinic_id'	       => $data['clinic_id'],
                'appointment_date' => $data['appointment_date'],
                'opening_time'	   => $data['opening_time'],
                'closing_time'	   => $data['closing_time'],
                'patient_capacity' => $data['patient_capacity'],
                'ot_status'	       => $data['ot_status']
            ]);
        }

        return false;
    }

    public function deleteAppointmentSchedule($id) {
        $schedule = AppointmentSchedule::find($id);

        if($schedule) {
            return $schedule->delete();
        }

        return false;
    }
}