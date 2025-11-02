<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentTypeRequest extends FormRequest
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
        return [
            'appointmentType' => 'required|string|max:255|unique:appointment_types,appt_type_name'.($this->isMethod('put') ? ',' . $this->route('id'): ''),
            'abbreviation'    => 'required|string|max:10'
        ];
    }

    public function messages()
    {
        return [
            'appointmentType.required' => 'Please enter the appointment type.',
            'appointmentType.string'   => 'The appointment type must be a valid string.',
            'appointmentType.max'      => 'The appointment type should not exceed 255 characters.',
            'appointmentType.unique'   => 'This appointment type already exists.',
            'abbreviation.required'    => 'Please enter the abbreviation.',
            'abbreviation.string'      => 'The abbreviation must be a valid string.',
            'abbreviation.max'         => 'The abbreviation should not exceed 10 characters.',
        ];
    }

    public function getAppointmentType() {
        $data = $this->validated();

        $data['abbreviation'] = strtoupper($data['abbreviation']);

        if($this->routeIs('doctor.appointment-type.store')) {
            $data['created_at'] = now()->format('Y-m-d H:i:s');
            $data['updated_at'] = now()->format('Y-m-d H:i:s');
        } else if($this->routeIs('doctor.appointment-type.update')) {
            $data['updated_at'] = now()->format('Y-m-d H:i:s');
            unset($data['id']);
        }

        return $data;
    }
}
