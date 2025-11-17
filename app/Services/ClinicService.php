<?php
namespace App\Services;

use App\Models\Clinic;

class ClinicService {
    public function createClinic($data) {
        $clinic = Clinic::whereRaw('LOWER(name) = ?', [strtolower($data['name'])])->first();

        if($clinic) {
            return false;
        }

        $createClinicData = [
            'name'         => $data['name'],
            'address'      => $data['address'],	
            'city'         => $data['city'],
            'phone_number' => $data['phone_number'],
            'floor'        => $data['floor'],
            'room_number'  => $data['room_number'],
            'image_path'   => $data['image_path'] ?? null,
            'description'  => $data['description'] ?? null,

        ];

        return Clinic::create($createClinicData);
    }

    public function getAllClinic() {
        return Clinic::get();
    }

    public function getClinicById($id) {
        return Clinic::find($id);
    }

    public function updateClinic($data, $id) {
        $clinic = Clinic::find($id);

        if($clinic) {
            return $clinic->update($data);
        }

        return false;
    }

    public function deleteClinic($id) {
        $clinic =  Clinic::find($id);

        if($clinic) {
            return $clinic->delete();
        }

        return false;
    }
}