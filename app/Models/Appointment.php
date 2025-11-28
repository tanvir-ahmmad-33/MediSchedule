<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age',
        'address',
        'city',
        'appointment_types_id',
        'clinics_id',
        'appointment_schedules_id',
        'description',
        'status',
        'appointment_number'
    ];

    public function appointmentType() {
        return $this->belongsTo(AppointmentType::class, 'appointment_types_id');
    }

    public function clinic() {
        return $this->belongsTo(Clinic::class, 'clinics_id');
    }

    public function appointmentSchedule() {
        return $this->belongsTo(AppointmentSchedule::class, 'appointment_schedules_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function(self $appointment) {
            $appointment->appointment_number = $appointment->generateAppointmentNumber();
        });
    }

    protected function generateAppointmentNumber() { 
        $typeCode = $this->appointmentType->appt_type_code ?? 'UNK';
        $typeCode = Str::upper($typeCode);

        do {
            $randomPart = Str::upper(Str::random(6));
            $number = "APT-{$typeCode}-{$randomPart}";
        } while(self::where('appointment_number', $number)->exists());

        return $number;
    }

    public function scopeSearch($query, $search) {
        if($search) {
            return $query->where('address', 'like', '%' . $search . '%');
        }

        return $query;
    }
}
