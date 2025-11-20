<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'doctor';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $nowTime = Carbon::now()->format('H:i');

        return [
            'clinic_id'        => 'required|exists:clinics,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'opening_time'     =>  [
                                    'required', 'date_format:H:i',
                                    Rule::when(request('appointment_date') === Carbon::today()->format('Y-m-d'), 
                                    ['after_or_equal:'. $nowTime]),
                                  ],
            'closing_time'     => 'required|date_format:H:i|after:opening_time',
            'patient_capacity' => 'required|integer|min:1',
            'ot_status'        => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'clinic_id.required'        => 'Please select a healthcare facility.',
            'clinic_id.exists'          => 'The selected healthcare facility is invalid.',

            'appointment_date.required' => 'Please select a consultation date.',
            'appointment_date.date'     => 'Please enter a valid date for the consultation.',

            'opening_time.required'     => 'Please select a consultation start time.',
            'opening_time.date_format'  => 'The start time must be in the format HH:mm.',

            'closing_time.required'     => 'Please select a consultation finish time.',
            'closing_time.date_format'  => 'The finish time must be in the format HH:mm.',
            'closing_time.after'        => 'The finish time must be after the start time.',

            'patient_capacity.required' => 'Please enter the number of patients allowed.',
            'patient_capacity.integer'  => 'The patient capacity must be a valid number.',
            'patient_capacity.min'      => 'The patient capacity must be at least 1.',

            'ot_status.required'        => 'Please select whether the operation will happen.',
            'ot_status.boolean'         => 'The operation status must be a true or false value.',
        ];
    }


    public function getAppointmentSchedule() {
        $data = $this->validated();

        if($this->routeIs('doctor.appointment-schedule.store')) {
            $data['created_at'] = now()->format('Y-m-d H:i:s');
            $data['updated_at'] = now()->format('Y-m-d H:i:s');
        } else {
            $data['updated_at'] = now()->format('Y-m-d H:i:s');
            unset($data['id']);
        }

        return $data;
    }
}
