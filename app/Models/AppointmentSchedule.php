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
    ];

    public function clinic() {
        return $this->belongsTo(Clinic::class);
    }
}
