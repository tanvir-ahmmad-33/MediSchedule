<?php
namespace App\Services;

use App\Models\AppointmentType;

class AppointmentTypeService {
    public function appointmentTypeExistenceCheck($data) {
        return AppointmentType::where('appt_type_code', $data['abbreviation'])
                                ->orWhere('appt_type_name', $data['appointmentType'])
                                ->first();
    }

    public function createAppointmentType($data) {
        $createAppointmentTypeData = [
            'appt_type_code' => $data['abbreviation'],
            'appt_type_name' => $data['appointmentType'],
            'icon'           => $data['icon'],
            'min_price'      => $data['minPrice'],
            'max_price'      => $data['maxPrice'],
            'discount'       => $data['discount'],
            'description'    => $data['description'],
            'status'         => 'active'
        ];

        return AppointmentType::create($createAppointmentTypeData);
    }

    public function getAppointmentTypes() {
        return AppointmentType::get();
    }

    public function getActiveAppointmentTypes() {
        return AppointmentType::where('status', 'active')->get();
    }
    
    public function getAllAppointmentType($search, $perPage) {
        return AppointmentType::search($search)->paginate($perPage);
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
            'icon'           => $data['icon'],
            'min_price'      => $data['minPrice'],
            'max_price'      => $data['maxPrice'],
            'discount'       => $data['discount'],
            'description'    => $data['description'],
            'updated_at'     => $data['updated_at']
        ]);

        return $appointmentType;
    }

    public function updateAppointmentTypeStatus($status, $id) {
        $appointmentType = AppointmentType::find($id);

        if($appointmentType) {
            $appointmentType->status = $status;
            $appointmentType->save();
            return true;
        }

        return false;
    }

    public function deleteAppointmentType($id) {
        $appointmentType = AppointmentType::findOrFail($id);

        if($appointmentType) {
            return $appointmentType->delete();
        }

        return false;
    }
}