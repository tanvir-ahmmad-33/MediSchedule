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
    
    #appointment-type-table tbody tr td {
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
<div class="row mb-3 mt-3">
    <div class="col-12 col-md-12 col-lg-6 d-flex justify-content-center gap-2 justify-content-lg-start">
        <form action="" method="GET" id="appt-type-search-form">
            <div class="d-flex flex-row gap-2">
                <div class="input-group ">
                    <span class="input-group-text border border-secondary-emphasis"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="search" id="search" class="form-control-sm border border-secondary-emphasis" value="{{ request()->input('search') }}" placeholder="Search here...">
                </div>
            
                <button type="submit" class="btn btn-sm btn-secondary search-btn">Search</button>
            </div>
        </form>
    </div>

    <div class="col-12 col-md-12 col-lg-6 d-flex justify-content-center gap-2 mt-3 mt-lg-0 justify-content-lg-end">
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createAppointmentType">Create Appointment Type</button>
        <button class="btn btn-sm btn-primary btn-refresh">Refresh</button>
    </div>
</div>

<div class="table-responsive shadow">
    <table class="table table-striped m-0" id="appointment-type-table">
        <thead class="">
            <tr>
                <th scope="col" class="text-center">Sl. No.</th>
                <th scope="col" class="text-center">Appointment Type Name</th>
                <th scope="col" class="text-center">Abbreviation</th>
                <th scope="col" class="text-center">Manage</th>
            </tr>
        </thead>
        <tbody>
            @include('doctor.appointment-type.appointment-type-table-data')
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div id="pagination-section">
    @if(request()->input('search'))
        <div class="pagination-container">
            {!! $appointmentTypes->appends(['search' => request()->input('search')])->links('pagination::bootstrap-5') !!}
        </div>
    @else
        <div class="pagination-container">
            {{ $appointmentTypes->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<!-- Create Appointment Type Modal -->
<div class="modal fade" id="createAppointmentType" tabindex="-1" aria-labelledby="createAppointmentTypeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createAppointmentTypeLabel">Create New Appointment Type</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <form action="#" method="POST" id="create-appointment-type-form">
            @csrf

            <div class="form-group p-3 pt-2">
                <label for="appointment_type_name" class="form-label">Appointment Type Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                    <input type="text" name="appointment_type_name" id="appointment_type_name" class="form-control" value="" placeholder="Enter appointment type name">
                </div>
            </div>

            <div class="form-group p-3 pb-2 pt-0">
                <label for="" class="form-label">Abbreviation</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                    <input type="text" name="abbreviation" id="abbreviation" class="form-control" value="" placeholder="Enter Abbreviation">
                </div>
            </div>

            <hr class="modal-hr text-secondary-emphasis">

            <div class="d-flex justify-content-center gap-2 mb-3">
                <button type="submit" class="btn btn-success">Create Appointment Type</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Edit Appointment Type Modal -->
<div class="modal fade" id="editAppointmentType" tabindex="-1" aria-labelledby="editAppointmentTypeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editAppointmentTypeLabel">Edit New Appointment Type</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <form action="#" method="POST" id="edit-appointment-type-form">
            @csrf

            <input type="hidden" name="id" id="id" value="">

            <div class="form-group p-3 pt-2">
                <label for="appointment_type_name" class="form-label">Appointment Type Name</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                    <input type="text" name="appointment_type_name" id="appointment_type_name" class="form-control" value="" placeholder="Enter appointment type name">
                </div>
            </div>

            <div class="form-group p-3 pb-2 pt-0">
                <label for="" class="form-label">Abbreviation</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                    <input type="text" name="abbreviation" id="abbreviation" class="form-control" value="" placeholder="Enter Abbreviation">
                </div>
            </div>

            <hr class="modal-hr text-secondary-emphasis">

            <div class="d-flex justify-content-center gap-2 mb-3">
                <button type="submit" class="btn btn-success">Edit Appointment Type</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            url: "{{ route('doctor.appointment-type.index') }}",
            type: "GET",
            success: function(response) {
                $('#appointment-type-table tbody').html(response.tableContent);
                $('#pagination-section').html(response.pagination);
            },
            error(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to reload the table.',
                });
            }
        });
    }

    $("#appt-type-search-form").on("submit", function(e) {
        e.preventDefault();

        const search = $("#search").val();

        console.log(search);
        if(search) {
            $.ajax({
                url: "{{ route('doctor.appointment-type.index') }}",
                type: "GET",
                data: {
                    search: search
                },
                success: function(response) {
                    $('#appointment-type-table tbody').html(response.tableContent);
                    $('#pagination-section').html(response.pagination);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to search. Please try again.',
                    });
                }
            })
        } else {
            reloadTable();
        }
    });

    $(".btn-refresh").on('click', function(e) {
        e.preventDefault();
        $('#search').val('');
        reloadTable();
    });

    $("#create-appointment-type-form").on("submit", function(e) {
        e.preventDefault();

        const appointmentType = $("#create-appointment-type-form #appointment_type_name").val();
        const abbreviation    = $("#create-appointment-type-form #abbreviation").val();

        console.log(appointmentType);
        console.log(abbreviation);

        if(abbreviation.length > 10) {
            $("#createAppointmentType").modal('hide');

            Swal.fire({
                title: 'Invalid Abbreviation',
                text: 'The abbreviation should not be longer than 10 characters.',
                timer: 5000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false
            });

            return;
        }

        if(appointmentType == "" || abbreviation == "") {
            $("#createAppointmentType").modal('hide');

            Swal.fire({
                title: 'Missing Information',
                text: 'Both appointment type and abbreviation are required.',
                timer: 5000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false
            });

            return;
        }

        $.ajax({
            url: "{{ route('doctor.appointment-type.store') }}",
            type: "POST",
            data: {
                appointmentType: appointmentType,
                abbreviation: abbreviation
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);

                $('#createAppointmentType').modal('hide');

                if(response.exists) {
                    Swal.fire({
                        icon: 'error',
                        text: response['message'],
                        timer: 5000,
                        timerProgressBar: true,
                        showConfirmButton: true,
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                    });
                }
                else if(response['status']) {
                    Swal.fire({
                        icon: 'success',
                        text: response['message'],
                        timer: 5000,
                        timerProgressBar: true,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#28a745',
                    }).then(() => {
                        reloadTable();
                    });
                } else {
                    handleAjaxResponseError(response.message);
                }

                const form = $(this);
                form[0].reset();
            },
            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error)
            }
        });
    });

    $(document).on('click', '.edit-btn', function(e) {
        e.preventDefault();

        const id = $(this).data('id');

        $.ajax({
            url: "{{ route('doctor.appointment-type.edit', ':id') }}".replace(':id', id),
            type: "GET",
            success: function(response) {
                console.log(response);

                if (response.status && response.appointmentType) {
                    $("#editAppointmentType").modal('show');

                    $("#editAppointmentType #appointment_type_name").val(response.appointmentType.appt_type_name);
                    $("#editAppointmentType #abbreviation").val(response.appointmentType.appt_type_code);
                    $("#editAppointmentType #id").val(response.appointmentType.id);
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Appointment Type not found.',
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
                    text: 'An error occurred while fetching the appointment type data.',
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

    $("#edit-appointment-type-form").on("submit", function(e) {
        e.preventDefault();

        const appointmentType = $("#edit-appointment-type-form #appointment_type_name").val();
        const abbreviation    = $("#edit-appointment-type-form #abbreviation").val();
        const id              = $("#edit-appointment-type-form #id").val();

        console.log(appointmentType);
        console.log(abbreviation);

        if(abbreviation.length > 10) {
            $("#createAppointmentType").modal('hide');

            Swal.fire({
                title: 'Invalid Abbreviation',
                text: 'The abbreviation should not be longer than 10 characters.',
                timer: 5000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false
            });

            return;
        }

        if(appointmentType == "" || abbreviation == "") {
            $("#createAppointmentType").modal('hide');

            Swal.fire({
                title: 'Missing Information',
                text: 'Both appointment type and abbreviation are required.',
                timer: 5000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false
            });

            return;
        }

        $.ajax({
            url: "{{ route('doctor.appointment-type.update', ':id') }}".replace(':id', id),
            type: "PUT",
            data: {
                appointmentType: appointmentType,
                abbreviation: abbreviation,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);

                $('#editAppointmentType').modal('hide');

                if(response['status']) {
                    Swal.fire({
                        icon: 'success',
                        text: response['message'],
                        timer: 5000,
                        timerProgressBar: true,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#28a745',
                    }).then(() => {
                        reloadTable();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response['message'],
                        timer: 5000,
                        timerProgressBar: true,
                        showConfirmButton: true,
                        confirmButtonText: 'Try Again',
                        confirmButtonColor: '#28a745',
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log('Request Failed');
                console.log('Status: ' + status);
                console.log('Error: ' + error);

                $('#editAppointmentType').modal('hide');
        
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

    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();

        const name = $(this).data('name');
        let id   = $(this).data('id');


        console.log(name);
        console.log(id);

        Swal.fire({
            title: `Are you sure you want to delete<br>${name}?`,
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#28a745',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it!',
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: "{{ route('doctor.appointment-type.destroy', ':id') }}".replace(':id', id),
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);

                        if(response['status']) {
                            Swal.fire({
                                icon: 'success',
                                text: response['message'],
                                timer: 5000,
                                timerProgressBar: true,
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#28a745',
                            }).then(() => {
                                reloadTable();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                text: response['message'],
                                timer: 5000,
                                timerProgressBar: true,
                                showConfirmButton: true,
                                confirmButtonText: 'Try Again',
                                confirmButtonColor: '#d33',
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Request Failed');
                        console.log('Status: ' + status);
                        console.log('Error: ' + error);
        
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
            }
        });
    })
</script>
@endpush