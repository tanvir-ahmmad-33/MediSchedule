<?php

namespace App\Http\Requests;

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
        return [
            'clinicName'              => 'required|string|max:255',
            'clinicAddress'           => 'required|string|max:255',
            'clinicCity'              => 'required|string|max:255',
            'weekDay'                 => 'required|in:saturday,sunday,monday,tuesday,wednesday,thursday,friday',
            'operationalAvailability' => 'required|in:available,unavailable',
            'openingTime'             => 'required|date_format:H:i',
            'closingTime'             => 'required|date_format:H:i',
            'consultationCapacity'    => 'required|integer|min:1',
        ];
    }

    public function messages() {
        return [
            'clinicName.required' => 'The clinic name is required.',
            'clinicName.string' => 'The clinic name must be a valid string.',
            'clinicName.max' => 'The clinic name may not be greater than 255 characters.',

            'clinicAddress.required' => 'The clinic address is required.',
            'clinicAddress.string' => 'The clinic address must be a valid string.',
            'clinicAddress.max' => 'The clinic address may not be greater than 255 characters.',

            'clinicCity.required' => 'The clinic city is required.',
            'clinicCity.string' => 'The clinic city must be a valid string.',
            'clinicCity.max' => 'The clinic city may not be greater than 255 characters.',

            'weekday.required' => 'Please select a weekday.',
            'weekday.in' => 'The weekday must be one of the following: Saturday, Sunday, Monday, Tuesday, Wednesday, Thursday, Friday.',

            'operationalAvailability.required' => 'Please specify if the clinic is available.',
            'operationalAvailability.in' => 'The operational availability must be either "available" or "unavailable".',

            'consultationCapacity.required' => 'The patient capacity is required.',
            'consultationCapacity.integer' => 'The patient capacity must be an integer.',
            'consultationCapacity.min' => 'The patient capacity must be at least 1.',

            'openingTime.required' => 'Please provide the opening time.',
            'openingTime.date_format' => 'The opening time must be in the format HH:MM.',

            'closingTime.required' => 'Please provide the closing time.',
            'closingTime.date_format' => 'The closing time must be in the format HH:MM.',
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
