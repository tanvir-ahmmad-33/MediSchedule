<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $fillable = [
        'user_id',
        'age',
        'working_section',
        'employment_status',
        'image_path',
        'experience'
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search) {

        switch($search) {
            case 'nurse':
                return $query->where('working_section', 'like', '%nurse%');
            case 'receptionist':
                return $query->where('working_section', 'receptionist');
            case 'assistant':
                return $query->where('working_section', 'assistant');
            case 'technician':
                return $query->where('working_section', 'technician');
            case 'active':
                return $query->where('employment_status', 'active');
            case 'leave':
                return $query->where('employment_status', 'on_leave');
            case 'sick':
                return $query->where('employment_status', 'sicked');
            case 'festival':
                return $query->where('employment_status', 'festival_off');
            default:
                return $query;
        }
    }
}