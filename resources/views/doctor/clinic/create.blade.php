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
    <h2 class="text-center mt-3 mb-0">Create A Healthcare Facility Profile</h2>
    <p class="text-center text-muted mb-2">Provide the necessary details to set up your clinic profile</p>
    
    @include('partials.form.clinic-create-form')
</div>
@endsection

@push('scripts')
<script>
    $("#create-clinic-form").on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        let isValid = true;
        let errors = [];
        
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();

        const name        = form.find("#name").val().trim();
        const address     = form.find("#address").val().trim();
        const city        = form.find("#city").val().trim();
        const phoneNumber = form.find("#phone_number").val().trim();
        const floor       = form.find("#floor").val();
        const roomNumber  = form.find("#room_number").val().trim(); 
        const phoneRegex  = /^01[3-9]\d{8}$/; 
        
        
        function validateField(selector, message, condition) {
            if (condition) {
                isValid = false;
                errors.push(message);
                const input = form.find(selector);
                input.addClass('is-invalid');
                input.after(`<div class="invalid-feedback">${message}</div>`);
            }
        }
        
        validateField('#name', 'Clinic name is required.', !name);
        validateField('#address', 'Street address is required.', !address);
        validateField('#city', 'City is required.', !city);

        if (!phoneNumber || !phoneNumber.match(phoneRegex)) {
            validateField('#phone_number', 'Enter a valid phone number (e.g., 01xxxxxxxxx).', true);
        } else {
            form.find('#phone_number').addClass('is-valid').removeClass('is-invalid');
        }

        if (!floor || isNaN(floor) || parseInt(floor) <= 0) {
            validateField('#floor', 'Floor must be a number greater than 0.', true);
        } else {
             form.find('#floor').addClass('is-valid').removeClass('is-invalid');
        }

        if (!roomNumber) {
            validateField('#room_number', 'Room number is required.', true);
        } else {
             form.find('#room_number').addClass('is-valid').removeClass('is-invalid');
        }

        if (!isValid) {
            return;
        }

        const formData = new FormData(form[0]); 

        const submitBtn = form.find('button[type="submit"]'); 
        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating Healthcare Facility...');

        
        $.ajax({
            url: "{{ route('doctor.clinic.store') }}",
            type: "POST",
            data: formData,
            processData: false, 
            contentType: false, 

            success: function(response) {
                console.log(response);

                if(response.status) {
                    handleAjaxResponseSuccess(response.message, "{{ route('doctor.clinic.index') }}");
                } else {
                    handleAjaxResponseError(response.message);
                }
                form[0].reset();
            },
            
            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error); 
            },

            complete: function() {
                submitBtn.prop('disabled', false).text('Create New Healthcare Facility');
            }
        });
    });
</script>
@endpush