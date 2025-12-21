<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'appt_type_code',
        'appt_type_name',
        'icon',
        'min_price',
        'max_price',
        'discount',
        'description',
        'status'
    ];


    public function scopeSearch($query, $search) {
        return $query->where('appt_type_name', 'like', '%' . $search . '%')
                    ->orWhere('appt_type_code', 'like', '%' . $search . '%')
                    ->orWhere('status', $search);
    }
}
