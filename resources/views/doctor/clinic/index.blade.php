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
        --mikado-yellow: #ffc107;
        --deep-koamaru: #293b5f;
    }

    .button-section {
       padding: 15px;
    }   

    .clinic-details-title {
        font-size: 32px;
        font-weight: bold;
        text-shadow: 0px 0px 5px rgba(0, 128, 0, 0.3);
        background-color: var(--dark-charcoal);
        color: var(--bright-gray);
        padding: 0px 10px;
        border-radius: 10px;
        margin-top: 15px;
        margin-bottom: 10px;
    }

    .card {
        margin: 20px 0;
    }

    .card:hover {
        background-color: var(--deep-koamaru);
        color: var(--white);
        transform: translateY(0px);
    }

    .clinic-card-icon {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
        width: 50px;
        border-radius: 50%;
        padding: 7px;
        margin-top: 20px;
    }

    .clinic-card-button {
        font-weight: 550;
        border-width: 1.5px;
    }

    
    .clinic-details-image {
        width: 100%;
        height: 100%;
    }

    .clinic-details-image img {
        object-fit: cover;
        border-radius: 25px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        height: 300px;
    }

    .create-card-icon {
        background-color: var(--medium-sea-green);
        color: var(--white);
        box-shadow: 0 4px 15px rgba(60, 179, 113, 0.5);
    }

    .delete-card-icon {
        background-color: var(--rusty-red);
        color: var(--white);
        box-shadow: 0 4px 15px rgba(183, 28, 28, 0.5);
    }

    .edit-card-icon {
        background-color: var(--mikado-yellow);
        color: var(--white);
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.5);
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
<div class="row button-section">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow">
            <div class="d-flex justify-content-center">
                <i class="fa-solid fa-house-medical fa-2x clinic-card-icon create-card-icon"></i>
            </div>
            <div class="card-body text-center">
                <h5 class="card-title fs-6">Create New Healthcare Facility</h5>
                <a href="{{ route('doctor.clinic.create') }}" class="btn btn-sm btn-outline-success mt-1 create-card-button clinic-card-button">Setup Now</a>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow">
            <div class="d-flex justify-content-center">
                <i class="fa-solid fa-house-medical fa-2x clinic-card-icon delete-card-icon"></i>
            </div>
            <div class="card-body text-center">
                <h5 class="card-title fs-6">Remove Healthcare Facilities</h5>
            <a href="#" class="btn btn-sm btn-outline-danger data-delete-card-button clinic-card-button">View All Healthcare Facility To Remove</a>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow">
            <div class="d-flex justify-content-center">
                <i class="fa-solid fa-house-medical fa-2x clinic-card-icon edit-card-icon"></i>
            </div>
            <div class="card-body text-center">
                <h5 class="card-title fs-6">Update Healthcare Facility Info</h5>
            <a href="#" class="btn btn-sm btn-outline-warning data-edit-card-button clinic-card-button">View All Healthcare Facility To Update</a>
            </div>
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="d-flex justify-content-center">
        <span class="clinic-details-title">Healthcare Facility Details</span>
    </div>
    @include('doctor.clinic.clinic-data')
</div>

@include('doctor.clinic.modal.all-clinics-delete-card-modal')
@include('doctor.clinic.modal.edit-modal')
@include('doctor.clinic.modal.all-clinics-edit-card-modal')
@include('doctor.clinic.modal.details-modal')
@endsection

@push('scripts')
<script>
    $(document).on('click', '.details-button', function(e) {
        e.preventDefault();

        const clinicId = $(this).data('id');
        console.log(clinicId);

        $.ajax({
            url: "{{ route('doctor.clinic.show', ':id') }}".replace(':id', clinicId),
            type: "GET",
            success: function(response) {
                console.log(response);

                if(response.status) {
                    $("#clinicDetailsModal").modal('show');
                    $("#clinicDetailsModal #clinicDetailsModalLabel").text(response.clinic.name);

                    if(response.clinic.image_path) {
                        const imageUrl = "{{ Storage::url('') }}" + response.clinic.image_path;
                        $("#clinicDetailsModal .image").prop('src', imageUrl);
                    } else {
                        $("#clinicDetailsModal .image").prop('src', '{{ asset("assets/image/default-img.png") }}');
                    }

                    $("#clinicDetailsModal .address").text(response.clinic.address);
                    $("#clinicDetailsModal .city").text(response.clinic.city);

                    $("#clinicDetailsModal .phone_number").text(response.clinic.phone_number);
                    $("#clinicDetailsModal .room_number").text(response.clinic.room_number);
                    $("#clinicDetailsModal .floor").text(response.clinic.floor);

                    if(response.clinic.description) {
                        $("#clinicDetailsModal .description").text(response.clinic.description);
                    } else {
                        $("#clinicDetailsModal .description").hide();
                    }
                } else {
                    handleAjaxResponseError(response.message);
                }
            },
            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            }
        })
    });
    
    $(document).on('click', '.data-edit-card-button', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('doctor.clinic.getAll') }}",
            type: "GET",
            success: function(response) {
                if(response.status) {
                    $("#allClinicsEditModal").modal('show');
                    $('.edit-clinic-table tbody').html(response.tableContent);
                } else {
                    handleAjaxResponseError(response.message);
                }
            },
            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            }
        });
    });

    $(document).on('click', '.data-delete-card-button', function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('doctor.clinic.getAll') }}",
            type: "GET",
            success: function(response) {
                if(response.status) {
                    $("#allClinicsDeleteModal").modal('show');
                    $('.delete-clinic-table tbody').html(response.tableContent);
                } else {
                    handleAjaxResponseError(response.message);
                }
            },
            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            }
        });
    });

    $(document).on('click', '.modal-delete-button, .table-delete-button', function(e) {
        e.preventDefault();
        console.log('delete button clicked');

        $("#allClinicsDeleteModal").modal('hide');

        const clinicId   = $(this).data('id');
        const clinicName = $(this).data('name');

        Swal.fire({
            title: 'Are you want to delete?',
            html: `<strong>Healthcare Facility</strong>: ${clinicName}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#d33',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: "{{ route('doctor.clinic.destroy', ':id') }}".replace(':id', clinicId),
                    type: "DELETE",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);

                        if(response.status) {
                            Swal.fire({
                                text: response.message,
                                icon: 'success',
                                timer: 5000,
                                timerProgressBar: true,
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#28a745'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            handleAjaxResponseError(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        handleAjaxError(xhr, status, error);
                    }
                })
            } else {
                Swal.fire('Cancelled', 'The clinic was not deleted.', 'info');
            }
        });
    });

    $(document).on('click', '.modal-edit-button, .table-edit-button', function(e) {
        e.preventDefault();
        console.log('edit button clicked');

        $("#allClinicsEditModal").modal('hide');
        const $clinicId = $(this).data('id');
        
        $.ajax({
            url: "{{ route('doctor.clinic.edit', ':id') }}".replace(':id', $clinicId),
            type: "GET",
            success: function(response) {
                console.log(response);

                if(response.status) {
                    $("#editClinicModal").modal('show');

                    $('#editClinicModal #editClinicModalLabel').text('Update ' + response.clinic.name);

                    $('#editClinicModal #edit-clinic-form #id').val(response.clinic.id);
                    $('#editClinicModal #edit-clinic-form #name').val(response.clinic.name);
                    $('#editClinicModal #edit-clinic-form #address').val(response.clinic.address);
                    $('#editClinicModal #edit-clinic-form #city').val(response.clinic.city);
                    $('#editClinicModal #edit-clinic-form #floor').val(response.clinic.floor);
                    $('#editClinicModal #edit-clinic-form #room_number').val(response.clinic.room_number);
                    $('#editClinicModal #edit-clinic-form #phone_number').val(response.clinic.phone_number);
                    
                    let imagePath = response.clinic.image_path;
                    if (imagePath && !imagePath.startsWith('/')) {
                        imagePath = '/' + imagePath;
                    }

                    if (imagePath) {
                        const imageUrl = '/storage' + imagePath; 
                        $('#editClinicModal #current_clinic_image_display').attr('src', imageUrl).show(); 
                    } else {
                        $('#editClinicModal #current_clinic_image_display').hide(); 
                    }

                    $('#editClinicModal #image').val('');
                    $('#editClinicModal #description').val(response.clinic.description);
                } else {
                    handleAjaxResponseError(response.message);
                }
            },
            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            }
        });
    });

    $(document).on('submit', '#edit-clinic-form', function(e) {
        e.preventDefault();

        const form = $(this);
        let isValid = true;
        let errors = [];

        console.log(form);

        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();

        function ValidateField(selector, message) {
            isValid = false;
            errors.push(message);
            const input = form.find(selector);
            input.addClass('is-invalid');
            input.after(`<div class="invalid-feedback">${message}</div>`);
        }

        const name        = form.find("#name").val().trim();
        const address     = form.find("#address").val().trim();
        const city        = form.find("#city").val().trim();
        const floor       = form.find("#floor").val();
        const roomNumber  = form.find("#room_number").val().trim();
        const phoneNumber = form.find("#phone_number").val().trim();
        const phoneRegex  = /^01[3-9]\d{8}$/;

        if(!name) { 
            ValidateField('#name', 'Clinic name is required.'); 
        }
        else { 
            form.find("#name").addClass('is-valid').removeClass('is-invalid'); 
        }

        if(!address) { 
            ValidateField('#address', 'Street address is required.'); 
        }
        else { 
            form.find("#address").addClass('is-valid').removeClass('is-invalid'); 
        }

        if(!city) { 
            ValidateField('#city', 'City is required.'); 
        }
        else { 
            form.find("#city").addClass('is-valid').removeClass('is-invalid'); 
        }

        if(!floor || isNaN(floor) || parseInt(floor) <= 0) { 
            ValidateField('#floor', 'Floor must be a number greater than 0.'); 
        } 
        else { 
            form.find("#floor").addClass('is-valid').removeClass('is-invalid'); 

        }

        if(!roomNumber) { 
            ValidateField('#room_number', 'Room number is required.'); 
        } 
        else { 
            form.find("#room_number").addClass('is-valid').removeClass('is-invalid'); 
        }

        if(!phoneNumber || !phoneNumber.match(phoneRegex)) { 
            ValidateField('#phone_number', 'Enter a valid phone number (e.g., 01xxxxxxxxx).'); 
        } 
        else { 
            form.find("#phone_number").addClass('is-valid').removeClass('is-invalid'); 
        }

        if(!isValid) {
            return;
        }

        const formData = new FormData(form[0]);
        const clinicId = form.find("#id").val();


        console.log(clinicId);
        logFormData(formData);

        const submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        submitBtn.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Updating Healthcare Facility...');

        $.ajax({
            url: "{{ route('doctor.clinic.update', ':id') }}".replace(':id', clinicId),
            type: "POST",
            data: formData,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            processData: false,
            contentType: false,

            success: function(response) {
                console.log(response);

                if(response.status) {
                    $("#editClinicModal").modal('hide');
                    handleAjaxResponseSuccess(response.message);
                } else {
                    handleAjaxResponseError(response.message);
                }
                form[0].reset();
            },

            error(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            },

            complete: function() {
                submitBtn.prop('disabled', false);
                submitBtn.text('Update Healthcare Facility')
            }
        });
    });
</script>
@endpush

