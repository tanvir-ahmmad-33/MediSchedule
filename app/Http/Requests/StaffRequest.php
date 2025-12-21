<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaffRequest extends FormRequest
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
        if($this->routeIs('doctor.staff.store')) {
            return [
                'first_name'      => 'required|string|max:255',
                'last_name'       => 'required|string|max:255',
                'phone'           => 'required|regex:/^01[3-9]\d{8}$/',
                'email'           => [
                    'required',
                    'email',
                    Rule::unique('users','email')->ignore($this->route('doctor.staff.approve'))
                ],
                'age'             => 'required|numeric|min:18',
                'role'            => 'required|in:staff',
                'gender'          => 'required|in:male,female,other',
                'working_section' => 'required|in:nurse,assistant,receptionist,technician,senior_nurse',
                'experience'      => 'required|numeric|min:0',
                'password'        => 'required|string|min:8',
                'profile_image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ];
        } if($this->routeIs('doctor.staff.approve')) {
            return [
                'age'             => 'required|numeric|min:18',
                'working_section' => 'required|in:nurse,assistant,receptionist,technician,senior_nurse',
                'experience'      => 'required|numeric|min:0',
            ];
        }

        return [];
    }

    public function messages()
    {
        if($this->routeIs('doctor.staff.store')) {
            return [
                'first_name.required' => 'First Name is required.',
                'first_name.string'   => 'First Name must be a valid string.',
                'first_name.max'      => 'First Name cannot exceed 255 characters.',

                'last_name.required'  => 'Last Name is required.',
                'last_name.string'    => 'Last Name must be a valid string.',
                'last_name.max'       => 'Last Name cannot exceed 255 characters.',

                'phone.required'      => 'Phone number is required.',
                'phone.regex'         => 'Please enter a valid Bangladeshi phone number.',

                'email.required'      => 'Email is required.',
                'email.email'         => 'Please enter a valid email address.',
                'email.unique'        => 'The email address is already taken.',
        
                'age.required'        => 'Age is required.',
                'age.numeric'         => 'Age must be a number.',
                'age.min'             => 'Age must be at least 18.',

                'role.required'       => 'Role is required.',
                'role.in'             => 'Please select a valid role.',

                'gender.required'     => 'Gender is required.',
                'gender.in'           => 'Please select a valid gender.',

                'working_section.required' => 'Profession is required.',
                'working_section.in'      => 'Please select a valid profession.',
        
                'experience.required' => 'Experience is required.',
                'experience.numeric'  => 'Experience must be a valid number.',
                'experience.min'      => 'Experience must be at least 0.',

                'password.required'   => 'Password is required.',
                'password.string'     => 'Password must be a valid string.',
                'password.min'        => 'Password must be at least 8 characters long.',

                'profile_image.image' => 'Please upload a valid image.',
                'profile_image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
                'profile_image.max'   => 'The image must not be greater than 2MB.',
            ];
        } else if($this->routeIs('doctor.staff.approve')) {
            return [
                'age.required'        => 'Age is required.',
                'age.numeric'         => 'Age must be a number.',
                'age.min'             => 'Age must be at least 18.',

                'working_section.required' => 'Profession is required.',
                'working_section.in'      => 'Please select a valid profession.',
        
                'experience.required' => 'Experience is required.',
                'experience.numeric'  => 'Experience must be a valid number.',
                'experience.min'      => 'Experience must be at least 0.',
            ];
        }

        return [];
    }

    public function getStaff() {
        $data = $this->validated();

        if($this->routeIs('doctor.staff.store') || $this->routeIs('doctor.staff.approve')) {
            $data['created_at'] = now()->format('Y-m-d H:i:s');
            $data['updated_at'] = now()->format('Y-m-d H:i:s');
        }

        return $data;
    }
}
