<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClinicRequest extends FormRequest
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
            'name'         => 'required|string|max:255',
            'address'      => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'phone_number' => 'required|regex:/^01[3-9]\d{8}$/',
            'floor'        => 'required|numeric|min:1',
            'room_number'  => 'required|numeric|min:1',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'  => 'nullable|string|max:500',
        ];
    }

    public function messages() {
        return [
            'name.required'         => 'The clinic name is required.',
            'name.string'           => 'The clinic name must be a valid string.',
            'name.max'              => 'The clinic name cannot exceed 255 characters.',

            'address.required'      => 'The address is required.',
            'address.string'        => 'The address must be a valid string.',
            'address.max'           => 'The address cannot exceed 255 characters.',

            'city.required'         => 'The city is required.',
            'city.string'           => 'The city must be a valid string.',
            'city.max'              => 'The city cannot exceed 255 characters.',

            'phone_number.required' => 'The phone number is required.',
            'phone_number.regex'    => 'Please enter a valid phone number (e.g., 01XXXXXXXXX).',

            'floor.required'        => 'The floor number is required.',
            'floor.numeric'         => 'The floor number must be a numeric value.',
            'floor.min'             => 'The floor number must be greater than 0.',

            'room_number.required'  => 'The room number is required.',
            'room_number.numeric'   => 'The room number must be a numeric value.',
            'room_number.min'       => 'The room number must be greater than 0.',

            'image.image'           => 'The image must be a valid image file.',
            'image.mimes'           => 'The image must be of type: jpeg, png, jpg, gif, svg.',
            'image.max'             => 'The image must not exceed 2MB in size.',

            'description.string'    => 'The description must be a valid string.',
            'description.max'       => 'The description cannot exceed 500 characters.',
        ];
    }


    public function getClinic() {
        $data = $this->validated();

        if($this->hasFile('image') && $this->file('image')->isValid()) {
            $ext = $this->file('image')->getClientOriginalExtension();
            $fileName = now()->timestamp . '.' . $ext;
        
            $data['image_path'] = $this->file('image')->storeAs('clinics', $fileName, 'public');
        }

        if($this->routeIs('doctor.clinic.store')) {
            $data['created_at'] = now()->format('Y-m-d H:i:s');
            $data['updated_at'] = now()->format('Y-m-d H:i:s');
        } else {
            $data['updated_at'] = now()->format('Y-m-d H:i:s');
            unset($data['id']);
        }

        return $data;
    }
}
