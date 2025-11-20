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
    
    #appointment-schedule-table tbody tr td {
        font-size: 0.9rem;
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
<div class="d-flex justify-content-between mb-3 mt-3">
    <div class="search">
        <form action="{{ route('doctor.appointment-schedule.index') }}" method="GET" id="appointment-schedule-search-form">
            <div class="d-flex flex-row gap-2">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-filter"></i></span>
                        <select name="schedule-search-category" id="schedule-search-category" class="form-control-sm border border-primary-emphasis">
                            <option value="" class="text-muted" disabled selected>Select Search Category </option>
                            <option value="name"      {{ request()->input('schedule-search-category') == 'name' ? 'selected' : '' }}>       By Clinic Name  </option>
                            <option value="address"   {{ request()->input('schedule-search-category') == 'address' ? 'selected' : '' }}>    By Location     </option>
                            <option value="city"      {{ request()->input('schedule-search-category') == 'city' ? 'selected' : '' }}>       By City         </option>
                            <option value="weekday"   {{ request()->input('schedule-search-category') == 'weekday' ? 'selected' : '' }}>    By Weekday      </option>
                            <option value="ot_status" {{ request()->input('schedule-search-category') == 'ot_status' ? 'selected' : '' }}>  By OT Status    </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="schedule-search-value" id="schedule-search-value" class="form-control-sm border border-primary-emphasis" value="{{ request()->input('schedule-search-value') }}" placeholder="Search here ...">
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-secondary">Search</button>
            </div>
        </form>
    </div>
    <div>
        <a href="{{ route('doctor.appointment-schedule.create') }}">
            <button class="btn btn-sm btn-success btn-sechedule-create">Create Appointment Schedule</button>
        </a>
        <button class="btn btn-sm btn-primary btn-refresh">Refresh</button>
    </div>
</div>

<div class="table-responsive shadow">
    <table class="table table-striped m-0" id="appointment-schedule-table">
        <thead>
            <tr>
                <th scope="col" class="text-center">Sl. No.</th>
                <th scope="col" class="text-center">Healthcare Facilities Name</th>
                <th scope="col" class="text-center">Consultation Date</th>
                <th scope="col" class="text-center">WeekDay</th>
                <th scope="col" class="text-center">Operational Availability</th>
                <th scope="col" class="text-center">Patient Appoinments</th>
                <th scope="col" class="text-center">More Details</th>
                <th scope="col" class="text-center">Manage</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @include('doctor.appointment-schedule.appointment-schedule-table-data')
        </tbody>
    </table>
</div>

<div id="pagination-section">
    <div class="pagination-container">
        {{ $appointmentSchedules->links('pagination::bootstrap-5') }}
    </div>
</div>

@include('doctor.appointment-schedule.modal.details-modal')
@include('doctor.appointment-schedule.modal.edit-modal')
@endsection

@push('scripts')
<script>
    $(document).on('click', '.details-btn', function(e) {
        e.preventDefault();

        const scheduleId = $(this).data('id');

        $.ajax({
            url: "{{ route('doctor.appointment-schedule.show', ':id') }}".replace(':id', scheduleId),
            type: "GET",
            success: function(response) {
                console.log(response);

                if(response.status) {
                    $("#detailsModal").modal('show');

                    
                    $("#detailsModal .schedule-details-healthcare-name").text(response.appointmentSchedule.clinic.name);
                    $("#detailsModal .schedule-details-healthcare-address").text(response.appointmentSchedule.clinic.address);
                    $("#detailsModal .schedule-details-healthcare-city").text(response.appointmentSchedule.clinic.city);

                    $("#detailsModal .schedule-details-schedule-date").text(response.appointmentSchedule.appointment_date);
                    $("#detailsModal .schedule-details-schedule-weekday").text(response.appointmentSchedule.weekday);

                    $("#detailsModal .schedule-details-schedule-start-time").text(response.appointmentSchedule.opening_time);
                    $("#detailsModal .schedule-details-schedule-end-time").text(response.appointmentSchedule.closing_time);

                    $("#detailsModal .schedule-details-patient-capacity").text(response.appointmentSchedule.patient_capacity);

                    const otStatus = response.appointmentSchedule.ot_status;

                    if(otStatus === 1) {
                        $("#detailsModal .schedule-details-ot-status").text('Available');
                    } else {
                        $("#detailsModal .schedule-details-ot-status").text('Unavailable');
                    }
                }
            },
            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            }
        });
    });

    $(document).on('submit', '#appointment-schedule-search-form', function(e) {
        e.preventDefault();

        const form = $(this);

        const searchValue = form.find('#schedule-search-value').val();
        const searchField = form.find('#schedule-search-category').val();

        if(!searchValue || !searchField) {
            Swal.fire({
                icon: 'error',
                text: 'Please fill in both the search category and search value.',
                timer: 5000,
                timerProgressBar: true,
                showConfirmButton: true,
                confirmButtonText: "Close",
                confirmButtonColor: "#28a745",
            });
            return;
        }

        $.ajax({
            url: "{{ route('doctor.appointment-schedule.index') }}",
            type: "GET",
            data: {
                'schedule-search-value': searchValue,
                'schedule-search-category': searchField
            },

            success: function(response) {
                console.log(response);

                $('#appointment-schedule-table tbody').html(response.htmlContent);
                $('#pagination-section .pagination-container').html(response.pagination);
            },

            error(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            }
        })
    });

    $(document).on('click', '.btn-refresh', function(e) {
        $('#schedule-search-category').val('');
        $('#schedule-search-value').val('');

        $.ajax({
            url: "{{ route('doctor.appointment-schedule.index') }}",
            type: "GET",
            data: {
                'schedule-search-value': '',
                'schedule-search-category': ''
            },

            success: function(response) {
                console.log(response);

                $('#appointment-schedule-table tbody').html(response.htmlContent);
                $('#pagination-section .pagination-container').html(response.pagination);
            },

            error(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            }
        })
    });

    $(document).on('click', '.edit-button', function(e) {
        e.preventDefault();

        const scheduleId = $(this).data('id');

        $.ajax({
            url: "{{ route('doctor.appointment-schedule.edit', ':id') }}".replace(':id', scheduleId),
            type: "GET",

            success: function(response) {
                console.log(response);

                if(response.status) {
                    $("#editScheduleModal").modal('show');

                    let clinicSelect = $("#editScheduleModal #clinic_id");
                    clinicSelect.empty();

                    if(response.appointmentSchedule.clinics && response.appointmentSchedule.clinics.length > 0) {
                        response.appointmentSchedule.clinics.forEach(function(clinic) {
                            if(clinic.id == response.appointmentSchedule.clinic_id) {
                                clinicSelect.append(`<option value="${clinic.id}" selected>${clinic.name}</option>`);
                            } else {
                                clinicSelect.append(`<option value="${clinic.id}">${clinic.name}</option>`);
                            }
                        });
                    } else {
                        clinicSelect.append(`<option value="">No healthcare facility found</option>`);
                    }

                    $("#editScheduleModal #id").val(response.appointmentSchedule.id);
                    $("#editScheduleModal #appointment_date").val(response.appointmentSchedule.appointment_date);
                    $("#editScheduleModal #opening_time").val(response.appointmentSchedule.opening_time);
                    $("#editScheduleModal #closing_time").val(response.appointmentSchedule.closing_time);
                    $("#editScheduleModal #patient_capacity").val(response.appointmentSchedule.patient_capacity);
                    $("#editScheduleModal input[name='ot_status'][value='"+response.appointmentSchedule.ot_status+"']").prop('checked', true);
                } else {
                    handleAjaxResponseError(response.message);
                }
            },

            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            }
        })
    });

    $(document).on('submit', '#appointment-schedule-edit-form', function(e) {
        e.preventDefault();

        $("#editScheduleModal").modal('hide');

        const form = $(this);
        let isValid = true;

        function errorField(selector, message) {
            isValid = false;
            const input = form.find(selector);
            input.addClass('is-invalid');
            input.after(`<div class="invalid-feedback">${message}</div>`);
        }

        function timeFomat(time) {
            const timeArray = time.split(':');

            const hours   = timeArray[0].padStart(2, '0');
            const minutes = timeArray[1].padStart(2, '0');

            return `${hours}:${minutes}`;
        }

        const scheduleId       = form.find('#id').val();
        const clinicId         = form.find("#clinic_id").val();
        const appointmentDate  = form.find("#appointment_date").val();
        const openingTime      = form.find("#opening_time").val();
        const closingTime      = form.find("#closing_time").val();
        const patientCapacity  = form.find("#patient_capacity").val();
        const otStatus         = form.find("input[name='ot_status']:checked").val();

        if(!clinicId) {
            errorField("#clinic_id", "Please select a healthcare facility.");
        } else {
            form.find("#clinic_id").addClass('is-valid').removeClass('is-invalid');
        }

        if(!appointmentDate) {
            errorField("#appointment_date", "Please select a consultation date.");
        } else {
            form.find("#appointment_date").addClass('is-valid').removeClass('is-invalid');
        }

        if(!openingTime) {
            errorField("#opening_time", "Please select a consultation start time.");
        } else {
            form.find("#opening_time").addClass('is-valid').removeClass('is-invalid');
        }

        if(!closingTime) {
            errorField("#closing_time", "Please select a consultation finish time.");
        } else {
            form.find("#closing_time").addClass('is-valid').removeClass('is-invalid');
        }

        if (openingTime && closingTime && openingTime >= closingTime) {
            errorField('#closing_time', 'Finish time must be later than start time.');
        }

        if (!patientCapacity || patientCapacity <= 0) {
            errorField('#patient_capacity', 'Please enter a valid patient limit (greater than 0).');
        }
        

        if(!isValid) {
            return
        }

        const formData = new FormData(form[0]);
        formData.set('opening_time', timeFomat(openingTime));
        formData.set('closing_time', timeFomat(closingTime));
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('_method', 'PUT');

        const submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        submitBtn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Editing Appointment Schedule...');

        $.ajax({
            url: "{{ route('doctor.appointment-schedule.update', ':id') }}".replace(':id', scheduleId),
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function(response) {
                console.log(response);

                if(response.status) {
                    handleAjaxResponseSuccess(response.message);
                } else {
                    handleAjaxResponseError(response.message);
                }

                form[0].reset();
            },

            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            },

            complete: function() {
                submitBtn.prop('disabled', false);
                submitBtn.text('Edit Appointment Schedule');
            }
        });
    });

    $(document).on('click', '.delete-button', function(e) {
        e.preventDefault();

        const scheduleId   = $(this).data('id');
        const scheduleName = $(this).data('name');
        console.log(scheduleName);

        Swal.fire({
            title: "Are you want to delete?",
            html: `<span class="text-danger"><strong>${scheduleName}</strong></span>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: "#d33",
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: "{{ route('doctor.appointment-schedule.destroy', ':id') }}".replace(':id', scheduleId),
                    type: "DELETE",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },

                    success: function(response) {
                        console.log(response);

                        if(response.status) {
                            handleAjaxResponseSuccess(response.message);
                        } else {
                            handleAjaxResponseError(response.message);
                        }
                    },

                    error: function(xhr, status, errror) {
                        handleAjaxError(xhr, status, error);
                    }
                });
            }
        });
    });
</script>
@endpush