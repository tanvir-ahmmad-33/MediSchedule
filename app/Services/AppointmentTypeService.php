<?php
namespace App\Services;

use App\Models\AppointmentType;

class AppointmentTypeService {
    public function getAllAppointmentType($search, $perPage) {
        return AppointmentType::search($search)->paginate($perPage);
    }

    public function appointmentTypeExistenceCheck($data) {
        return AppointmentType::where('appt_type_code', $data['abbreviation'])
                                ->orWhere('appt_type_name', $data['appointmentType'])
                                ->first();
    }

    public function createAppointmentType($data) {
        $createAppointmentTypeData = [
            'appt_type_code' => $data['abbreviation'],
            'appt_type_name' => $data['appointmentType'],
        ];

        return AppointmentType::create($createAppointmentTypeData);
    }

    public function getAppointmentTypeById($id) {
        return AppointmentType::find($id);
    }

    public function updateAppointmentType($data, $id) {
        $appointmentType = AppointmentType::find($id);

        if (!$appointmentType) {
            return false;
        }

        $appointmentType->update([
            'appt_type_code' => $data['abbreviation'],
            'appt_type_name' => $data['appointmentType'],
            'updated_at'     => $data['updated_at']
        ]);

        return $appointmentType;
    }

    public function deleteAppointmentType($id) {
        $appointmentType = AppointmentType::findOrFail($id);

        if($appointmentType) {
            return $appointmentType->delete();
        }

        return false;
    }
}