<?php
namespace App\Services;

use App\Models\AppointmentSchedule;

class AppointmentScheduleService {
    public function getAllAppointmentSchedule($searchValue, $searchField, $perPage) {
        return AppointmentSchedule::search($searchValue, $searchField)
                                ->orderByRaw("FIELD(weekday, 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')")
                                ->paginate($perPage);
    }

    public function getAppointmentScheduleById($id) {
        return AppointmentSchedule::find($id);
    }
}