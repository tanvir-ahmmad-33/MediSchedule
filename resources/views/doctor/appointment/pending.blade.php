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

    #appointment-table tbody tr td {
        font-size: 0.9rem;
    }

    .form-select-xs {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
        font-weight: 500;
        border-radius: 0.25rem;
    }


    .btn-xs {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        border-radius: 0.25rem;
    }

    #pagination-section {
        margin-top: 20px;
    }

    #pagination-section .pagination {
        margin-bottom: 0;
    }

    #pagination-section .pagination .page-link {
        font-size: 0.85rem;
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
<div class="row mt-3">
    <div class="col-12 col-lg-6 d-flex justify-content-center gap-2 justify-content-lg-start">
        <form action="" method="GET" id="appointment-search-form">
            <div class="d-flex flex-row gap-2">
                <div class="input-group ">
                    <span class="input-group-text border border-secondary-emphasis"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="search" id="search" class="form-control-sm border border-secondary-emphasis" value="" placeholder="Search here...">
                </div>
            
                <button type="submit" class="btn btn-sm btn-secondary search-btn">Search</button>
            </div>
        </form>
    </div>

    <div class="col-12 col-lg-6 d-flex justify-content-center gap-2 mt-3 mt-lg-0 justify-content-lg-end">
        <a href="{{ route('doctor.appointment.create') }}" class="btn btn-success btn-sm">Create Appointment</a>
        <button class="btn btn-sm btn-primary btn-refresh">Refresh</button>
    </div>
</div>

<div class="table-responsive mt-2 border border-1 rounded">
    <table class="table table-striped m-0" id="appointment-table">
        <thead>
            <tr>
                <th scope="col" class="text-center">Sl. No.</th>
                <th scope="col" class="text-center">Patient Name</th>
                <th scope="col" class="text-center">Age</th>
                <th scope="col" class="text-center">Address</th>
                <th scope="col" class="text-center">Appointment Type</th>
                <th scope="col" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @include('doctor.appointment.data.pending-appointment-data')
        </tbody>
    </table>
</div>
<div>
    {{ $appointments->links('pagination::bootstrap-5') }}
</div>

@include('doctor.appointment.modal.details')
@endsection

@push('scripts')
<script>
    $(document).on('change', '.select-status', function(e) {
        e.preventDefault();

        const select = $(this);
        
        select.removeClass('bg-warning bg-success bg-danger text-light');

        if(select.val() == 'pending') select.addClass('bg-warning').removeClass('bg-success text-light');
        else if(select.val() == 'approved') select.addClass('bg-success text-light').removeClass('');
        else select.addClass('bg-danger text-light');

        const appointmentId = select.data('id');
        const status        = select.val();

        Swal.fire({
            text: `You are about to change the status to`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!',
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: "{{ route('doctor.appointment.updateStatus', ':id') }}".replace(':id', appointmentId),
                    type: "PUT",
                    data: {
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {
                        console.log(response);

                        if(response.status) {
                            handleAjaxResponseSuccess(response.message);
                        } else {
                            handleAjaxResponseError(response.message);
                        }
                    },

                    error: function(xhr, status, error) {
                        handleAjaxError(xhr, status, error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.details-btn', function(e) {
        e.preventDefault();

        const appointmentId = $(this).data('id');

        $.ajax({
            url: "{{ route('doctor.appointment.show', ':id') }}".replace(':id', appointmentId),
            type: "GET",

            success: function(response) {
                console.log(response);

                if(response.status) {
                    $("#detailsModal").modal('show');

                    $("#detailsModal #detailsModalLabel").text('Appointment Number: ' + response.appointment.appointment_number);

                    $("#detailsModal .patient-name").text(response.appointment.user.name);
                    $("#detailsModal .patient-age").text(response.appointment.age);
                    if(response.appointment.user.gender == 'male') $("#detailsModal .patient-gender").text('Male');
                    else $("#detailsModal .patient-gender").text('Female');
                    $("#detailsModal .patient-phone").text(response.appointment.user.phone);
                    $("#detailsModal .patient-email").text(response.appointment.user.email);
                    $("#detailsModal .patient-address").text(response.appointment.address + ', ' + response.appointment.city);

                    $("#detailsModal .consultation-type").text(response.appointment.appointment_type.appt_type_name + ' (' + response.appointment.appointment_type.appt_type_code +')');
                    $("#detailsModal .appointed-time").text(convertTwelveFormat(response.appointment.appointment_schedule.opening_time) + ' - ' + convertTwelveFormat(response.appointment.appointment_schedule.closing_time));
                    $("#detailsModal .consultation-place-name").text(response.appointment.clinic.name);
                    $("#detailsModal .consultation-place-phone").text(response.appointment.clinic.phone_number);
                    $("#detailsModal .consultation-place-address").text(response.appointment.clinic.address + ', ' + response.appointment.clinic.city);
                } else {
                    handleAjaxResponseError(response.message);
                }
            },

            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            }
        })
    });
</script>
@endpush