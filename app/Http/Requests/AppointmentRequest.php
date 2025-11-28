<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'               => 'required|string|max:255',
            'last_name'                => 'required|string|max:255',
            'phone'                    => 'required|regex:/^01[3-9]\d{8}$/',
            'email'                    => 'required|email',
            'gender'                   => 'required|in:male,female,other',
            'password'                 => 'required|string|min:8',
            'age'                      => 'required|integer|between:1,125',
            'address'                  => 'required|string|max:255',
            'city'                     => 'required|string|max:255',	
            'appointment_types_id'     => 'required|exists:appointment_types,id',
            'clinics_id'               => 'required|exists:clinics,id',
            'appointment_schedules_id' => 'required|exists:appointment_schedules,id',
            'description'              => 'nullable|string|max:500'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'      => 'First name is required.',
            'first_name.string'        => 'First name must be a string.',
            'first_name.max'           => 'First name cannot be more than 255 characters.',
        
            'last_name.required'       => 'Last name is required.',
            'last_name.string'         => 'Last name must be a string.',
            'last_name.max'            => 'Last name cannot be more than 255 characters.',
        
            'phone.required'           => 'Phone number is required.',
            'phone.regex'              => 'A valid phone number is required (e.g., +88017******** / 017********).',
        
            'email.required'           => 'Email address is required.',
            'email.email'              => 'Please enter a valid email address.',
        
            'gender.required'          => 'Gender is required.',
            'gender.in'                => 'Gender must be one of the following: male, female, other.',
        
            'password.required'        => 'Password is required.',
            'password.string'          => 'Password must be a string.',
            'password.min'             => 'Password must be at least 8 characters long.',
        
            'age.required'             => 'Age is required.',
            'age.integer'              => 'Age must be a valid number.',
            'age.between'              => 'Age must be between 1 and 125.',
        
            'address.required'         => 'Address is required.',
            'address.string'           => 'Address must be a string.',
            'address.max'              => 'Address cannot be more than 255 characters.',
        
            'city.required'            => 'City is required.',
            'city.string'              => 'City must be a string.',
            'city.max'                 => 'City cannot be more than 255 characters.',
        
            'appointment_types_id.required' => 'Please select an appointment type.',
            'appointment_types_id.exists'  => 'The selected appointment type does not exist.',
        
            'clinics_id.required'      => 'Please select a clinic.',
            'clinics_id.exists'        => 'The selected clinic does not exist.',
        
            'appointment_schedules_id.required' => 'Please select an appointment schedule.',
            'appointment_schedules_id.exists'  => 'The selected appointment schedule does not exist.',
        
            'description.string'       => 'Description must be a string.',
            'description.max'          => 'Description cannot be more than 500 characters.',
        ];
    }



    public function getAppointments() {
        $data = $this->validated();

        if($this->routeIs('doctor.appointment.store')) {
            $data['created_at'] = now()->format('Y-m-d H:i:s');
            $data['updated_at'] = now()->format('Y-m-d H:i:s');
        } else {
            unset($data['id']);
            $data['updated_at'] = now()->format('Y-m-d H:i:s');
        }

        return $data;
    }
}
