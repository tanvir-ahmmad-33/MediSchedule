<?php

namespace App\Models;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppointmentSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinic_id',
        'appointment_date',
        'opening_time',
        'closing_time',
        'patient_capacity',
        'patient_appointed',
        'ot_status'
    ];

    public function clinic() {
        return $this->belongsTo(Clinic::class);
    }

    public function appointments() {
        return $this->hasMany(Appointment::class, 'appointment_schedules_id');
    }

    public function scopeWhereTimeOverlap($query, $date, $startTime, $endTime) {
        return $query->whereDate('appointment_date', $date)
                     ->where('opening_time', '<', $endTime)
                     ->where('closing_time', '>', $startTime);
    }

    public function scopeSearch($query, $searchValue, $searchField) {
        switch($searchField) {
            case 'name':
                return $query->whereHas('clinic', function($query) use ($searchValue) {
                    $query->where('name', 'like', '%' . $searchValue . '%');
                });
            case 'city':
                return $query->whereHas('clinic', function($query) use ($searchValue) {
                    $query->where('city', 'like', '%' . $searchValue . '%');
                });
            case 'address':
                return $query->whereHas('clinic', function($query) use ($searchValue) {
                    $query->where('address', 'like', '%' . $searchValue . '%');
                });
            case 'weekday':
                return $query->whereRaw('DAYOFWEEK(appointment_date) = ?', [intval($searchValue)]);
            case 'ot_status':
                return $query->where('ot_status', '=', $searchValue);
            default:
                return $query;
        }

        return $query;
    }
}
