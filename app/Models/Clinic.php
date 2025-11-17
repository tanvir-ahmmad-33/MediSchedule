<?php

namespace App\Models;

use App\Models\AppointmentSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'phone_number',
        'floor',
        'room_number',
        'image_path',
        'description'
    ];

    public function schedules() {
        return $this->hasMany(AppointmentSchedule::class);
    }
}
