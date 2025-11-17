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
<div class="d-flex justify-content-between mb-3">
    <div class="search">
        <form action="" method="GET" id="appt-schedule-search-form">
            @csrf

            <div class="d-flex flex-row gap-2">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search-value" id="search-value" class="form-control-sm border border-primary-emphasis" value="{{ request()->input('search-value') }}" placeholder="Search here ...">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-filter"></i></span>
                        <select name="search-category" id="search-category" class="form-control-sm border border-primary-emphasis">
                            <option value="" class="text-muted" disabled selected>Search Category </option>
                            <option value="name">                     By Clinic Name              </option>
                            <option value="location">                 By Location                 </option>
                            <option value="city">                     By City                     </option>
                            <option value="weekday">                  By Weekday                  </option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-secondary">Search</button>
            </div>
        </form>
    </div>
    <div>
        <button class="btn btn-sm btn-success btn-sechedule-create" data-bs-toggle="modal" data-bs-target="#createScheduleModal">Create Appointment Schedule</button>
        <button class="btn btn-sm btn-primary btn-refresh">Refresh</button>
    </div>
</div>

<div class="table-responsive shadow">
    <table class="table table-striped m-0" id="appointment-schedule-table">
        <thead>
            <tr>
                <th scope="col" class="text-center">Sl. No.</th>
                <th scope="col" class="text-center">Hospital/Clinic Name</th>
                <th scope="col" class="text-center">City</th>
                <th scope="col" class="text-center">Weekday</th>
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
    @if(request()->input('search-value') || request()->input('search-category'))
        <div class="pagination-container">
            {{ $appointmentSchedules->appends([
                'search-value' => request()->input('search-value'),
                'search-category' => request()->input('search-category')
            ])->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="pagination-container">
            {{ $appointmentSchedules->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<!-- More Details Modal -->
<div class="modal fade" id="moreDetailsModal" tabindex="-1" aria-labelledby="moreDetailsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="moreDetailsLabel"> ... </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <p class="m-3">
            <strong>Clinic Address:</strong>                   <span class="clinic-address"></span>           <br>
            <strong>City:</strong>                             <span class="city"></span>                     <br>
            <br>
            <strong>Surgical Assistance Availability:</strong> <span class="operational-availability"></span> <br>
            <br>
            <strong>Week of the day:</strong>                  <span class="weekday"></span>                  <br>
            <strong>Opening Time:</strong>                     <span class="opening-time"></span>             <br>
            <strong>Closing Time:</strong>                     <span class="closing-time"></span>             <br>
            <strong>Total Consultation Capacity:</strong>      <span class="patient-capacity"></span> <br>
        </p>
        <hr>
        <div class="d-flex justify-content-center mb-3">
            <button class="btn btn-sm btn-success w-25" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createScheduleModal" tabindex="-1" aria-labelledby="createScheduleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createScheduleModalLabel">Create Appointment Schedule</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <form action="#" method="POST" id="create-appointment-schedule-form">
            @csrf

            <div class="form-group m-3 mt-2">
                <label for="clinicName" class="form-label">Clinic/Hospital Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-hospital"></i></span>
                    <input type="text" name="clinicName" id="clinicName" class="form-control" value="" placeholder="Enter Clinic/Hospital Name">
                </div>
            </div>

            <div class="form-group m-3 mt-0">
                <label for="clinicAddress" class="form-label">Clinic/Hospital Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-map-pin"></i></span>
                    <input type="text" name="clinicAddress" id="clinicAddress" class="form-control" value="" placeholder="Enter Clinic/Hospital Address">
                </div>
            </div>

            <div class="form-group m-3 mt-0">
                <label for="clinicCity" class="form-label">Clinic/Hospital City</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-city"></i></span>
                    <input type="text" name="clinicCity" id="clinicCity" class="form-control" value="" placeholder="Enter Clinic/Hospital City">
                </div>
            </div>

            <div class="form-group m-3 mt-0">
                <label for="weekDay" class="form-label">Consoltation Day of the Week</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-calendar-week"></i></span>
                    <select name="weekDay" id="weekDay" class="form-control">
                        <option value="" selected disabled>Select a day</option>
                        <option value="saturday">Saturday</option>
                    </select>
                </div>
            </div>

            <div class="row m-3 mt-0">
                <div class="col-12 col-lg-6 p-0 pe-1">
                    <div class="form-group">
                        <label for="openingTime" class="form-label">Consultation Start Time</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-hourglass-start"></i></span>
                            <input type="time" name="openingTime" id="openingTime" class="form-control" value="" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 p-0 ps-1">
                    <div class="form-group">
                        <label for="closingTime" class="form-label">Consultation Finish Time</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-hourglass-end"></i></span>
                            <input type="time" name="closingTime" id="closingTime" class="form-control" value="" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group m-3 mt-0">
                <label for="consultationCapacity" class="form-label">Consultation Capacity</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-hospital-user"></i></span>
                    <input type="number" name="consultationCapacity" id="consultationCapacity" class="form-control" value="" placeholder="">
                </div>
            </div>

            <div class="form-group m-3 mt-0 mb-2">
                <label for="" class="form-label">Operational Availability</label>
                
                <div class="form-check">
                    <input class="form-check-input border border-dark" type="radio" name="operationalAvailability" id="available" value="available" >
                    <label class="form-check-label" for="available">
                        Available
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input border border-dark" type="radio" name="operationalAvailability" id="unavailable" value="unavailable" >
                    <label class="form-check-label" for="unavailable">
                        Unavailable
                    </label>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-center gap-2 mb-3">
                <button type="submit" class="btn btn-sm btn-success" data-bs-dismiss="modal">Create Appointment Schedule</button>
                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editScheduleModal" tabindex="-1" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-success" id="editScheduleModalLabel">Manage ...</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <form action="#" method="POST" id="edit-appointment-schedule-form">
            @csrf

            <input type="hidden" name="scheduleId" id="scheduleId">

            <div class="form-group m-3">
                <label for="clinicName" class="form-label">Clinic Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-hospital"></i></span>
                    <input type="text" name="clinicName" id="clinicName" class="form-control" value="" placeholder="">
                </div>
            </div>

            <div class="row p-3 pt-0">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="clinicAddress" class="form-label">House Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-map-pin"></i></span>
                            <input type="text" name="clinicAddress" id="clinicAddress" class="form-control" value="" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="clinicCity" class="form-label">City Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-city"></i></span>
                            <input type="text" name="clinicCity" id="clinicCity" class="form-control" value="" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group p-3 pt-0">
                <label for="weekDay" class="form-label">Choose Consultation Day</label>
                <select name="weekDay" id="weekDay" class="form-select">
                    <option value="saturday">Saturday</option>
                    <option value="sunday">Sunday</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                </select>
            </div>

            <div class="row p-3 pt-0">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="openingTime" class="form-label">Consultation Start Time</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-hourglass-start"></i></span>
                            <input type="time" name="openingTime" id="openingTime" class="form-control" value="" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="closingTime" class="form-label">Consultation Finish Time</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-hourglass-end"></i></span>
                            <input type="time" name="closingTime" id="closingTime" class="form-control" value="" placeholder="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-3 pt-0 pb-1">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="consultationCapacity" class="form-label">Consultation Capacity</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-hospital-user"></i></span>
                            <input type="number" name="consultationCapacity" id="consultationCapacity" class="form-control" value="" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="" class="form-label">Surgery Available</label>
                    <div class="d-flex flex-row">
                        <div class="form-check me-2">
                            <input class="form-check-input border border-dark" type="radio" name="operationalAvailability" value="available" id="available">
                            <label class="form-check-label" for="available">
                                Yes
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input border border-dark" type="radio" name="operationalAvailability" value="unavailable" id="unavailable">
                            <label class="form-check-label" for="unavailable">
                                No
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-center gap-2 mb-3">
                <button type="submit" class="btn btn-sm btn-success" data-bs-dismiss="modal">Apply Changes</button>
                <button type="button" class="btn btn-sm btn-outline-dark btn-light" data-bs-dismiss="modal">Discard Changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    function reloadTable() {
        $.ajax({
            url: "{{ route('doctor.appointment-schedule.index') }}",
            type: "GET",
            success: function(response) {
                $("#appointment-schedule-table tbody").html(response.tableContent);
                $("#pagination-section").html(response.pagination);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to reload the table.',
                });
            }
        });
    }

    $("#create-appointment-schedule-form").on('submit', function(e) {
        e.preventDefault();

        const clinicName              = $("#create-appointment-schedule-form #clinicName").val();
        const clinicAddress           = $("#create-appointment-schedule-form #clinicAddress").val();
        const clinicCity              = $("#create-appointment-schedule-form #clinicCity").val();
        const weekDay                 = $("#create-appointment-schedule-form #weekDay").val();
        const operationalAvailability = $("#create-appointment-schedule-form input[name='operationalAvailability']:checked").val();
        const openingTime             = $("#create-appointment-schedule-form #openingTime").val();
        const closingTime             = $("#create-appointment-schedule-form #closingTime").val();
        const consultationCapacity    = $("#create-appointment-schedule-form #consultationCapacity").val();

        let errors = [];

        if(!clinicName) {
            errors.push('Clinic name is required.');
            $('#create-appointment-schedule-form #clinicName').addClass('is-invalid');
        } else {
            $('#create-appointment-schedule-form #clinicName').removeClass('is-invalid').addClass('is-valid');
        }

        if(!clinicAddress) {
            errors.push('Clinic address is required.');
            $('#create-appointment-schedule-form #clinicAddress').addClass('is-invalid');
        } else {
            $('#create-appointment-schedule-form #clinicAddress').removeClass('is-invalid').addClass('is-valid');
        }

        if(!clinicCity) {
            errors.push('Clinic city is required.');
            $('#create-appointment-schedule-form #clinicCity').addClass('is-invalid');
        } else {
            $('#create-appointment-schedule-form #clinicCity').removeClass('is-invalid').addClass('is-valid');
        }

        if(!weekDay) {
            errors.push('Consultation day of the week is required.');
            $('#create-appointment-schedule-form #weekDay').addClass('is-invalid');
        } else {
            $('#create-appointment-schedule-form #weekDay').removeClass('is-invalid').addClass('is-valid');
        }

        if(!operationalAvailability) {
            errors.push('Operational availability is required.');
            $('#create-appointment-schedule-form #operationalAvailability').addClass('is-invalid');
        } else {
            $('#create-appointment-schedule-form #operationalAvailability').removeClass('is-invalid').addClass('is-valid');
        }

        if(!openingTime) {
            errors.push('Consultation start time is required..');
            $('#create-appointment-schedule-form #openingTime').addClass('is-invalid');
        } else {
            $('#create-appointment-schedule-form #openingTime').removeClass('is-invalid').addClass('is-valid');
        }

        if(!closingTime) {
            errors.push('Consultation finish time is required.');
            $('#create-appointment-schedule-form #closingTime').addClass('is-invalid');
        } else {
            $('#create-appointment-schedule-form #closingTime').removeClass('is-invalid').addClass('is-valid');
        }

        if(!consultationCapacity || consultationCapacity <= 0) {
            errors.push('Consultation capacity must be a positive number.');
            $('#create-appointment-schedule-form #consultationCapacity').addClass('is-invalid');
        } else {
            $('#create-appointment-schedule-form #consultationCapacity').removeClass('is-invalid').addClass('is-valid');
        }

        if(errors.length > 0) {
            Swal.fire({
                title: 'Missing Or invalid fields',
                html: errors.join("<br>"),
                showConfirmButton: true,
                confirmButtonText: 'Close',
                confirmButtonColor: '#d33',
            });
            return;
        }

        $.ajax({
            url: "{{ route('doctor.appointment-schedule.store') }}",
            type: "POST",
            data: {
                clinicName: clinicName,
                clinicAddress: clinicAddress,
                clinicCity: clinicCity,
                weekDay: weekDay,
                operationalAvailability: operationalAvailability,
                openingTime: openingTime,
                closingTime: closingTime,
                consultationCapacity: consultationCapacity,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console,log(response);
            },
            error: function(xhr, status, error) {
                console.log('Request Failed');
                console.log('Status: ' + status);
                console.log('Error: ' + error);

                $('#createScheduleModal').modal('hide');
        
                let errorMessage = 'Something went wrong! Please try again.';
        
                if (xhr.status === 422) {
                    errorMessage = 'Validation error: ' + xhr.responseText;
                } else if (xhr.status === 500) {
                    errorMessage = 'Server error: ' + xhr.responseText;
                } else {
                    errorMessage = 'Error: ' + xhr.statusText;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessage,
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: true
                });
            }
        });
    });

    $("#appt-schedule-search-form").on('submit', function(e) {
        e.preventDefault();

        const searchValue    = $("#appt-schedule-search-form #search-value").val();
        const searchCategory = $("#appt-schedule-search-form #search-category").val();

        console.log(searchValue);
        console.log(searchCategory);

        $.ajax({
            url: "{{ route('doctor.appointment-schedule.index') }}",
            type: "GET",
            data: {
                searchValue: searchValue,
                searchCategory: searchCategory
            },
            success: function(response) {
                console.log(response);

                $("#appointment-schedule-table tbody").html(response.tableContent);
                $("#pagination-container").html(response.pagination);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to fetch results.',
                });
            }
        });
    });

    $(document).on('click', '.btn-refresh', function(e) {
        e.preventDefault();

        reloadTable();
    });

    $(document).on('click', '.details-btn', function(e) {
        e.preventDefault();

        const id = $(this).data('id');

        $.ajax({
            url: "{{ route('doctor.appointment-schedule.show', ':id') }}".replace(':id', id),
            type: "GET",
            success: function(response) {
                console.log(response.appointmentSchedule);
                if(response.status) {
                    $("#moreDetailsModal .modal-title").text(response.appointmentSchedule.clinic_name);
                    
                    $("#moreDetailsModal .clinic-address").text(response.appointmentSchedule.clinic_address);
                    $("#moreDetailsModal .city").text(response.appointmentSchedule.clinic_city);

                    $("#moreDetailsModal .operational-availability").text(
                        response.appointmentSchedule.operational_availability.charAt(0).toUpperCase() + 
                        response.appointmentSchedule.operational_availability.slice(1)
                    );

                    $("#moreDetailsModal .weekday").text(response.appointmentSchedule.weekday);
                    $("#moreDetailsModal .opening-time").text(response.appointmentSchedule.opening_time);
                    $("#moreDetailsModal .closing-time").text(response.appointmentSchedule.closing_time);
                    $("#moreDetailsModal .patient-capacity").text(response.appointmentSchedule.patient_capacity);
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.message,
                        timer: 5000,
                        timerProgressBar: true,
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                    });
                }
            },
            error: function(xhr, status, success) {
                console.log(error);

                Swal.fire({
                    icon: 'error',
                    text: 'Something went wrong while fetching the appointment details. Please try again.',
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    confirmButtonText: 'Close',
                    confirmButtonColor: '#d33',
                });
            }
        })
    });

    $(document).on('click', '.edit-button',  function(e) {
        e.preventDefault();
    
        const id = $(this).data('id');
        
        $.ajax({
            url: "{{ route('doctor.appointment-schedule.edit', ':id') }}".replace(':id', id),
            type: "GET",
            success: function(response) {
                console.log(response);
                if(response.status) {
                    $("#editScheduleModal").modal('show');
                    $("#editScheduleModal .modal-title").text('Manage '+ response.appointmentSchedule.weekday + "'s Schedule for " + response.appointmentSchedule.clinic_name);

                    $("#editScheduleModal #scheduleId").val(response.appointmentSchedule.id);
                    $("#editScheduleModal #clinicName").val(response.appointmentSchedule.clinic_name);
                    $("#editScheduleModal #clinicAddress").val(response.appointmentSchedule.clinic_address);
                    $("#editScheduleModal #clinicCity").val(response.appointmentSchedule.clinic_city);

                    let weekday = response.appointmentSchedule.weekday.charAt(0).toLowerCase() + response.appointmentSchedule.weekday.slice(1).toLowerCase();
                    console.log(weekday);
                    var selector = "#editScheduleModal select[name='weekDay'] option[value='" + weekday + "']";
                    $(selector).prop('selected', true);

                    $("#editScheduleModal #openingTime").val(response.appointmentSchedule.opening_time);
                    $("#editScheduleModal #closingTime").val(response.appointmentSchedule.closing_time);

                    $("#editScheduleModal #consultationCapacity").val(response.appointmentSchedule.patient_capacity);
                    $("#editScheduleModal input[name='operationalAvailability'][value='" + response.appointmentSchedule.operational_availability + "']").prop('checked', true);


                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Appointment Schedule not found.',
                        icon: 'error',
                        timer: 5000,
                        timerProgressBar: true,
                        showConfirmButton: true,
                        confirmButtonText: 'Try Again',
                        confirmButtonColor: '#28a745',
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred while fetching the appointment schedule data.',
                    icon: 'error',
                    timer: 5000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false
                });
            }
        })
    });

    $("#edit-appointment-schedule-form").on('submit', function(e) {
        e.preventDefault();

        const scheduleId              = $("#edit-appointment-schedule-form #scheduleId").val();
        const clinicName              = $("#edit-appointment-schedule-form #clinicName").val();
        const clinicAddress           = $("#edit-appointment-schedule-form #clinicAddress").val();
        const clinicCity              = $("#edit-appointment-schedule-form #clinicCity").val();
        const weekDay                 = $("#edit-appointment-schedule-form #weekDay").val();
        const operationalAvailability = $("#edit-appointment-schedule-form input[name='operationalAvailability']:checked").val();
        const openingTime             = $("#edit-appointment-schedule-form #openingTime").val();
        const closingTime             = $("#edit-appointment-schedule-form #closingTime").val();
        const consultationCapacity    = $("#edit-appointment-schedule-form #consultationCapacity").val();

        console.log(clinicName);
        console.log(clinicAddress);
        console.log(clinicCity);
        console.log(weekDay);
        console.log(operationalAvailability);
        console.log(openingTime);
        console.log(closingTime);
        console.log(consultationCapacity);

        $.ajax({
            url: "{{ route('doctor.appointment-schedule.update',':id') }}".replace(':id', scheduleId),
            type: "PUT",
            data: {
                scheduleId: scheduleId,
                clinicName: clinicName,
                clinicAddress: clinicAddress,
                clinicCity: clinicCity,
                weekDay: weekDay,
                operationalAvailability: operationalAvailability,
                openingTime: openingTime,
                closingTime: closingTime,
                consultationCapacity: consultationCapacity
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.status) {
                    console.log(response);
                } else {
                    console.log("Error");
                }
            },
            error: function(xhr, error, status) {
                console.log('Request Failed');
                console.log('Status: ' + status);
                console.log('Error: ' + error);

                $('#editScheduleModal').modal('hide');
        
                let errorMessage = 'Something went wrong! Please try again.';
        
                if (xhr.status === 422) {
                    errorMessage = 'Validation error: ' + xhr.responseText;
                } else if (xhr.status === 500) {
                    errorMessage = 'Server error: ' + xhr.responseText;
                } else {
                    errorMessage = 'Error: ' + xhr.statusText;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessage,
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: true
                });
            }
        })
    });

    $(document).on('click', '.delete-button',  function(e) {
        e.preventDefault();

        const id         = $(this).data('id');
        const clinicName = $(this).data('name');
    });
    
</script>
@endpush