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
    <div class="m-3">
        <h3 class="text-center m-3 pt-2" style="text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.3);">Create An Appointment</h3>

        @include('partials.form.doctor-appointment-create-form')
    </div>
@endsection

@push('scripts')
<script>
    $(document).on('submit', '#doctor-appointment-create-form', function(e) {
        e.preventDefault();

        const form = $(this);
        let isValid = true;

        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();

        function fieldError(selector, message) {
            isValid = false;
            const input = form.find(selector);
            input.addClass('is-invalid');
            input.after(`<div class="invalid-feedback">${message}</div>`);
        }

        const firstName     = form.find('#first_name').val().trim();
        const lastName      = form.find('#last_name').val().trim();
        const phone         = form.find("#phone").val().trim();
        const email         = form.find("#email").val().trim();
        const gender        = form.find("#gender").val();
        const password      = form.find("#password").val();
        const age           = form.find("#age").val();
        const address       = form.find('#address').val().trim();
        const city          = form.find('#city').val().trim();
        const hospitalName  = form.find("#hospital_name").val();
        const apptTypeName  = form.find("#appt_type_name").val();
        const apptSchedule  = form.find("#appt_schedule").val();
        const description   = form.find("#description").val().trim() || null;

        
        const phoneRegex = /^01[3-9]\d{8}$/;
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

        console.log(firstName);

        if(!firstName) fieldError('#first_name', 'First name is required')
        else form.find('#first_name').removeClass('is-invalid').addClass('is-valid');
        

        if(!lastName) fieldError('#last_name', 'Last name is required')
        else form.find('#last_name').removeClass('is-invalid').addClass('is-valid');

        if(!phone || !phoneRegex.test(phone)) fieldError('#phone', 'A valid phone number is required (e.g., 017********)')
        else form.find('#phone').removeClass('is-invalid').addClass('is-valid');
        

        if(!email || !emailRegex.test(email)) fieldError('#email', 'A valid email is required')
        else form.find('#email').removeClass('is-invalid').addClass('is-valid');

        if(!gender) fieldError('#gender', 'Gender is required')
        else form.find('#gender').removeClass('is-invalid').addClass('is-valid');
        

        if(!password) fieldError('#password', 'Password is requred.')
        else if(password.length < 8) fieldError('#password', 'Password length must be greater than or equal to 8 characters.')
        else form.find('#password').removeClass('is-invalid').addClass('is-valid');
        

        if(!age || isNaN(age) || age <= 0 || age > 125) fieldError('#age', 'Please enter a valid age (e.g., 0-125).')
        else form.find('#age').removeClass('is-invalid').addClass('is-valid');

        if(!address) fieldError('#address', 'Address is required')
        else form.find('#address').removeClass('is-invalid').addClass('is-valid');
        

        if(!city) fieldError('#city', 'City is required')
        else form.find('#city').removeClass('is-invalid').addClass('is-valid');

        if(!hospitalName) fieldError('#hospital_name', 'Please select a hospital')
        else form.find('#hospital_name').removeClass('is-invalid').addClass('is-valid');

        if(!apptTypeName) fieldError('#appt_type_name', 'Please select an appointment type')
        else form.find('#appt_type_name').removeClass('is-invalid').addClass('is-valid');

        if(!apptSchedule) fieldError('#appt_schedule', 'Please select an appointment schedule')
        else form.find('#appt_schedule').removeClass('is-invalid').addClass('is-valid');
        
        if(!isValid) return;
        
        const submitBtn = form.find("button[type='submit']");
        submitBtn.prop('disabled', true);
        submitBtn.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Creating Appointment...');

        $.ajax({
            url: "{{ route('doctor.appointment.store') }}",
            type: "POST",
            data: {
                first_name: firstName,
                last_name:lastName,
                phone: phone,
                email: email,
                gender: gender,
                password: password,
                age: age,
                address: address,
                city: city,	
                appointment_types_id: apptTypeName,
                clinics_id: hospitalName,
                appointment_schedules_id: apptSchedule,
                description: description
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {
                console.log(response);

                if (response.status) {
                    handleAjaxResponseSuccess(response.message, "{{ route('doctor.appointment.index') }}");
                } else {
                    handleAjaxResponseError(response.message);
                }

                form[0].reset();
                form.find('.is-valid').removeClass('is-valid');
            },

            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            },

            complete: function() {
                submitBtn.prop('disabled', false);
                submitBtn.html('Create An Appointment');
            }
        });
    });

    $(document).on('change', '#hospital_name', function(e) {
        const clinicId = $(this).val();

        if(clinicId) {
            $.ajax({
                url: "{{ route('doctor.get-clinic-schedule', ':id') }}".replace(':id', clinicId),
                type: "GET",
                success: function(response) {
                    console.log(response);

                    if(response.status && response.schedules.length > 0) {
                        $("#doctor-appointment-create-form #appt_schedule").empty();

                        response.schedules.forEach(function(schedule) {
                            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                            const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

                            const date = new Date(schedule.appointment_date);
                            const day = date.getDate();
                            const month = months[date.getMonth()];
                            const dayOfWeek = daysOfWeek[date.getDay()];

                            const openingTime = convertTwelveFormat(schedule.opening_time);
                            const closingTime = convertTwelveFormat(schedule.closing_time);

                            const data = `${dayOfWeek}, ${day} ${month} (${openingTime} - ${closingTime})`;

                            $("#doctor-appointment-create-form #appt_schedule").append('<option value="' + schedule.id + '">'+ data +'</option>');
                        });
                    } else {
                        $("#doctor-appointment-create-form #appt_schedule").empty();
                        $("#doctor-appointment-create-form #appt_schedule").append('<option value="">No schedule available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    handleAjaxError(xhr, status, error);
                }
            });
        }
    });
</script>
@endpush