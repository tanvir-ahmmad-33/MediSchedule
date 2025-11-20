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
<div class="container">
    <h2 class="text-center mt-3 mb-0">Create An Appointment Schedule</h2>
    <p class="text-center text-muted mb-2">Please fill out the details below to create a new appointment schedule.</p>

    @include('partials.form.appointment-schedule-create-form')
</div>
@endsection

@push('scripts')
<script>
    $(document).on('submit', '#appointment-schedule-create-form', function(e) {
        e.preventDefault();
        console.log('Schedule Create From Clicked.');

        const form = $(this);
        let isValid = true;
        let errors = [];

        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();

        function validateField(selector, message) {
            isValid = false;
            errors.push(message);
            const input = form.find(selector);
            input.addClass('is-invalid');
            input.after(`<div class="invalid-feedback">${message}</div>`);
        }

        const clinicId        = form.find("#clinic_id").val();
        const appointmentDate = form.find("#appointment_date").val();
        const openingTime     = form.find("#opening_time").val();
        const closingTime     = form.find("#closing_time").val();
        const patientCapacity = form.find("#patient_capacity").val();
        const otStatus        = form.find("input[name='ot_status']:checked").val();

        if(!clinicId) {
            validateField('#clinic_id', 'Please select a healthcare facility.');
        } else {
            form.find("#clinic_id").addClass('is-valid').removeClass('is-invalid');
        }

        if(appointmentDate) {
            const appointmentDateTime = new Date(appointmentDate + 'T' + openingTime);
            const now = new Date();

            console.log(appointmentDateTime);

            if(appointmentDateTime <= now) {
                validateField('#appointment_date', 'Consultation date must be in the future.');
            } else {
                form.find("#appointment_date").addClass('is-valid').removeClass('is-invalid');
            }
        } else {
            validateField('#appointment_date', 'Please select a consultation date.');
        }

        if(!openingTime) {
            validateField('#opening_time', 'Please select a consultation start time.');
        } else {
            form.find("#opening_time").addClass('is-valid').removeClass('is-invalid');
        }

        if(!closingTime) {
            validateField('#closing_time', 'Please select a consultation finish time.');
        } else {
            form.find("#closing_time").addClass('is-valid').removeClass('is-invalid');
        }

        const startDateTime = new Date(appointmentDate + 'T' + openingTime);
        const endDateTime = new Date(appointmentDate + 'T' + closingTime);
        if (startDateTime >= endDateTime) {
            validateField('#closing_time', 'Consultation finish time must be after the start time.');
        }

        if(!patientCapacity || patientCapacity <= 0) {
            validateField('#patient_capacity', 'Please enter a valid patient capacity (greater than 0).');
        } else {
            form.find("#patient_capacity").addClass('is-valid').removeClass('is-invalid');
        }

        if(!otStatus) {
            validateField("input[name='ot_status']", '');
        } else {
            form.find("input[name='ot_status']").closest('.form-check').addClass('is-valid').removeClass('is-invalid');
        }

        if(!isValid) {
            return;
        }

        const formData = new FormData(form[0]);
        const submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        submitBtn.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Creating Appointment Schedule...');

        $.ajax({
            url: "{{ route('doctor.appointment-schedule.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response) {
                console.log(response);

                if(response.overlap) {
                    Swal.fire({
                        text: response.message,
                        icon: "error",
                        timer: 5000,
                        timerProgressBar: true,
                        showConfirmButton: true,
                        confirmButtonText: "Close",
                        confirmButtonColor: "#d33",
                    });
                } else {
                    if(response.status) {
                        handleAjaxResponseSuccess(response.message, "{{ route('doctor.appointment-schedule.index') }}");
                    } else {
                        handleAjaxResponseError(response.message);
                    }
                    form[0].reset();
                }
            },

            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            },

            complete: function() {
                submitBtn.prop('disabled', false).text('Create New Appointment Schedule');
            }
        });
    });
</script>
@endpush
