@extends('layouts.dashboard')

@push('styles')
<style>
    :root {
        --white: #fff;
        --alice-blue: #f1fbff;
        --medium-jungle-green: #1b3d32;
        --black: #000;
        --dark-charcoal: #333;
        --keppel: #4aa7a1;
        --bright-gray: #e6f3ef;
        --japanese-indigo: #303a47;
        --medium-sea-green: #48a36c;
        --rusty-red: #dc3545;
        --light-gray: #dadadaff;
    }
</style>
@endpush

@section('sidebar')
    @include('partials.sidebar.sidebar-doctor')
@endsection

@section('avatar')
    @if($doctor['gender'] == 'male')
        <img src="{{ asset('assets/avatar/male-doctor-avatar.png') }}" class="avatar img-fluid" alt="">
    @else
        <img src="{{ asset('assets/avatar/female-doctor-avatar.png') }}" class="avatar img-fluid" alt="">
    @endif
@endsection

@section('body-content')
<div class="mt-3 p-3 rounded">
    <h3 class="text-center mb-1">Create New Staff Member</h3>
    <p class="text-center text-muted">Please fill in the required details below to create a new staff member</p>
    @include('partials.form.staff-create-form')
</div>
@endsection

@push('scripts')
<script>
    $(document).on('submit', '#staff-profile-create-form', function(e) {
        e.preventDefault();

        const form = $(this);
        let isValid = true;

        form.find('.invalid-feedback').remove();
        form.find('.is-invalid').removeClass('is-invalid');

        function errorField(selector, message) {
            isValid = false;
            const input = form.find(selector);
            input.addClass('is-invalid');
            input.after(`<div class="invalid-feedback">${message}</div>`);
        }

        const phoneRegex = /^01[3-9]\d{8}$/;
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        const firstName  = form.find("#first_name").val().trim();
        const lastName   = form.find("#last_name").val().trim();
        const phone      = form.find("#phone").val();
        const email      = form.find("#email").val();
        const age        = form.find("#age").val();
        const role       = form.find("#role").val();
        const gender     = form.find("#gender").val();
        const profession = form.find("#working_section").val();
        const experience = form.find("#experience").val();
        const password   = form.find("#password").val();

        if(!firstName) errorField('#first_name', "Please enter the staff's first name.");
        else form.find("#first_name").removeClass('is-invalid').addClass('is-valid');

        if(!lastName) errorField('#last_name', "Please enter the staff's last name.");
        else form.find("#last_name").removeClass('is-invalid').addClass('is-valid');

        if(!phoneRegex.test(phone)) errorField('#phone', "Please enter a valid Bangladeshi phone number.");
        else form.find("#phone").removeClass('is-invalid').addClass('is-valid');

        if(!emailRegex.test(email)) errorField('#email', "Please enter a valid email address.");
        else form.find("#email").removeClass('is-invalid').addClass('is-valid');

        if(!age || age < 18) errorField('#age', "Please enter a valid age (18 or above).");
        else form.find("#age").removeClass('is-invalid').addClass('is-valid');
        
        if(!role) errorField('#role', "Please select a role.");
        else form.find("#role").removeClass('is-invalid').addClass('is-valid');

        if(!gender) errorField('#gender', "Please select a gender.");
        else form.find("#gender").removeClass('is-invalid').addClass('is-valid');
        
        if(!profession) errorField('#working_section', "Please select a profession.");
        else form.find("#working_section").removeClass('is-invalid').addClass('is-valid');

        if(!experience || experience < 0) errorField('#experience', "Please enter a valid experience.");
        else form.find("#experience").removeClass('is-invalid').addClass('is-valid');

        if (!password || password.length < 8) errorField('#password', "Password must be at least 8 characters long.");
        else form.find("#password").removeClass('is-invalid').addClass('is-valid');

        if(!isValid) {
            return false;
        }

        const formData = new FormData(form[0]);
        const submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        submitBtn.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Creating New Staff Member...');

        $.ajax({
            url: "{{ route('doctor.staff.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response) {
                console.log(response);
            },

            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            },

            complete: function() {
                submitBtn.prop('disabled', false).text('Create New Staff Member');
            }
        });
    });
</script>
@endpush