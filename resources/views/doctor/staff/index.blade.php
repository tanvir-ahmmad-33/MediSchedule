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

    .card {
        margin-bottom: 0.50rem;
    }

    .stats-card {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: var(--medium-jungle-green);
        width: 180px;
    }

    .stats-icon {
        margin:15px 0px 3px 0px;
        transition: transform 0.3s ease;
    }

    .stats-card .stats-number {
        margin: 3px;
        font-size: 1.15rem;
        font-weight: 600;
    }

    .stats-card .stats-label {
        margin-bottom: 8px;
    }

    .card:hover {
        transform: translateY(-2px);
        color: var(--bright-gray);
    }
    
    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 217, 126, 0.3);
    }

    #staff-table tbody tr td {
        font-size: 0.9rem;
        font-weight: 400;
    }

    .btn-xs {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        border-radius: 0.25rem;
    }
    

    #pagination-section .pagination {
        margin-bottom: 0;
    }

    #pagination-section .pagination .page-link {
        font-size: 0.8rem;
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
<div class="row mt-2 mb-2">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0">Staff Management</h4>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">View and manage all working staff members</p>
        </div>
        <a href="{{ route('doctor.staff.create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus me-1"></i> Add New Staff
        </a>
    </div>
</div>

<div class="d-flex flex-wrap gap-3">
    <div class="card stats-card text-center">
        <div class="stats-icon text-primary">
            <i class="fas fa-user-md fa-2x"></i>
        </div>
        <div class="stats-number text-primary mt-1">{{ $staffNumber }}</div>
        <div class="stats-label">Total Staff</div>
    </div>
    <div class="card stats-card text-center">
        <div class="stats-icon text-success mt-2 p-1">
            <i class="fas fa-user-check fa-2x"></i>
        </div>
        <div class="stats-number text-success mt-1"> {{ $activeStaffNumber }} </div>
        <div class="stats-label mb-2">Active Now</div>
    </div>
    <div class="card stats-card text-center">
        <div class="stats-icon text-warning mt-2 p-1">
            <i class="fas fa-user-clock fa-2x"></i>
        </div>
        <div class="stats-number text-warning mt-1"> {{ $onLeaveStaffNumber }} </div>
        <div class="stats-label mb-2">On Break</div>
    </div>
    <div class="card stats-card text-center">
        <div class="stats-icon text-info mt-2 p-1">
            <i class="fas fa-calendar-day fa-2x"></i>
        </div>
        <div class="stats-number text-info mt-1"> {{ $sickStaffNumber }} </div>
        <div class="stats-label mb-2">Sick</div>
    </div>
    <div class="card stats-card text-center">
        <div class="stats-icon text-danger mt-2 p-1">
            <i class="fas fa-hourglass-half fa-2x"></i>
        </div>
        <div class="stats-number text-danger mt-1"> {{ $pendingStaff }} </div>
        <div class="stats-label mb-2">Pending</div>
    </div>
</div>

<div class="shadow rounded p-2">
    <h6 class="mb-2" style="font-size: 1.2rem;">Filter Staff</h6>
    <div class="d-flex justify-content-between">
        <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-xs btn-outline-dark filter-btn {{ request('search') == 'all' ? 'active' : '' }}" data-filter="all">
                <i class="fas fa-users me-1"></i> All Staff
            </button>
            <button class="btn btn-xs btn-outline-dark filter-btn {{ request('search') == 'nurse' ? 'active' : '' }}" data-filter="nurse">
                <i class="fas fa-user-nurse me-1"></i><span></span> Nurses
            </button>
            <button class="btn btn-xs btn-outline-dark filter-btn {{ request('search') == 'receptionist' ? 'active' : '' }}" data-filter="receptionist">
                <i class="fa-solid fa-chalkboard-user me-1"></i> Receptionists
            </button>
            <button class="btn btn-xs btn-outline-dark filter-btn {{ request('search') == 'assistant' ? 'active' : '' }}" data-filter="assistant">
                <i class="fas fa-robot me-1"></i> Assistants
            </button>
            <button class="btn btn-xs btn-outline-dark filter-btn {{ request('search') == 'technician' ? 'active' : '' }}" data-filter="technician">
                <i class="fas fa-tools me-1"></i> Technicians
            </button>
            <button class="btn btn-xs btn-outline-dark filter-btn {{ request('search') == 'active' ? 'active' : '' }}" data-filter="active">
                <i class="fas fa-circle text-success me-1"></i> Active
            </button>
            <button class="btn btn-xs btn-outline-dark filter-btn {{ request('search') == 'leave' ? 'active' : '' }}" data-filter="leave">
                <i class="fas fa-circle text-warning me-1"></i> On Leave
            </button>
            <button class="btn btn-xs btn-outline-dark filter-btn {{ request('search') == 'sick' ? 'active' : '' }}" data-filter="sick">
                <i class="fas fa-circle text-info me-1"></i> Sick
            </button>
            <button class="btn btn-xs btn-outline-dark filter-btn {{ request('search') == 'festival' ? 'active' : '' }}" data-filter="festival">
                <i class="fas fa-circle text-warning me-1"></i> Festival Off
            </button>
        </div>
    </div>
</div>
<div class="table-responsive shadow mt-2 mb-2">
    <table class="table table-striped" id="staff-table">
        <thead>
            <tr>
                <th scope="col" class="text-center">Sl. No.</th>
                <th scope="col" class="text-center">Staff Name</th>
                <th scope="col" class="text-center">ID Number</th>
                <th scope="col" class="text-center">Occupation</th>
                <th scope="col" class="text-center">Status</th>
                <th scope="col" class="text-center">More details</th>
                <th scope="col" class="text-center">Assigned schedules</th>
                <th scope="col" class="text-center">Manage</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @include('doctor.staff.data.staff-data')
        </tbody>
    </table>
</div>

<div id="pagination-section">
    <div class="pagination-container">
         {{ $staffs->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
    </div>
</div>

@include('doctor.staff.modal.status')
@endsection

@push('scripts')
<script>
    $(document).on('click', '.filter-btn', function(e) {
        e.preventDefault();

        $(".filter-btn").removeClass('active');
        $(this).addClass('active');

        const filter = $(this).data('filter');
        console.log(filter);

        $.ajax({
            url: "{{ route('doctor.staff.index') }}",
            type: "GET",
            data: {
                search: filter,
            },

            success: function(response) {
                console.log(response);

                $("#staff-table tbody").html(response.htmlContent);
                    $("#pagination-section .pagination-container").html(response.pagination);
            },

            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            },
        });
    });

    $(document).on('click', '.status-btn', function(e) {
        e.preventDefault();

        const status         = $(this).data('status');
        const name           = $(this).data('name');
        const workingSection = $(this).data('wksection');
        const staffId        = $(this).data('id');
        let buttonHtml       = '';

        console.log(staffId);

        $("#statusModal").modal('show');
        $("#statusModal #staffName").text(name);
        $("#statusModal #staffWorkingSection").text(capitalizeFirstLetter(workingSection));


        if(status == 'active') {
            $("#statusModal #currentStatus").text(capitalizeFirstLetter(status)).addClass('badge bg-success');
            $("#statusModal #buttonTitle").text('Manage Active Status');
            buttonHtml = `
                        <button class="btn btn-sm btn-warning status-change-btn" data-status="festival_off" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                            <i class="fas fa-calendar-day me-1"></i> Festival Off
                        </button>
                        <button class="btn btn-sm btn-secondary status-change-btn" data-status="on_leave" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                            <i class="fas fa-bed me-1"></i> On Leave
                        </button>
                        <button class="btn btn-sm btn-info status-change-btn" data-status="sicked" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                            <i class="fas fa-temperature-high me-1"></i> Sick
                        </button>
                    `;
        }

        
        if(status == 'on_leave') {
            $("#statusModal #currentStatus").text(capitalizeFirstLetter(status)).addClass('badge bg-warning');
            $("#statusModal #buttonTitle").text('Manage Leave Status');

            buttonHtml = `
                <button class="btn btn-sm btn-success status-change-btn" data-status="active" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                    <i class="fas fa-check-circle me-1"></i> Activate
                </button>
                <button class="btn btn-sm btn-info status-change-btn" data-status="sicked" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                    <i class="fas fa-temperature-high me-1"></i> Sick
                </button>
                <button class="btn btn-sm btn-warning status-change-btn" data-status="festival_off" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                    <i class="fas fa-calendar-day me-1"></i> Festival Off
                </button>
            `;
        }

        if(status == 'sicked') {
            $("#statusModal #currentStatus").text(capitalizeFirstLetter(status)).addClass('badge bg-info');
            $("#statusModal #buttonTitle").text('Manage Sick Status');

            buttonHtml = `
                <button class="btn btn-sm btn-success status-change-btn" data-status="active" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                    <i class="fas fa-check-circle me-1"></i> Activate
                </button>
                <button class="btn btn-sm btn-warning status-change-btn" data-status="festival_off" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                    <i class="fas fa-calendar-day me-1"></i> Festival Off
                </button>
                <button class="btn btn-sm btn-secondary status-change-btn" data-status="on_leave" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                    <i class="fas fa-bed me-1"></i> On Leave
                </button>
            `;
        }

        if(status == 'festival_off') {
            $("#statusModal #currentStatus").text(capitalizeFirstLetter(status)).addClass('badge bg-warning');
            $("#statusModal #buttonTitle").text('Manage Festival Off Status');

            buttonHtml = `
                <button class="btn btn-sm btn-success status-change-btn" data-status="active" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                    <i class="fas fa-check-circle me-1"></i> Activate
                </button>
                <button class="btn btn-sm btn-info status-change-btn" data-status="sicked" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                    <i class="fas fa-temperature-high me-1"></i> Sick
                </button>
                <button class="btn btn-sm btn-secondary status-change-btn" data-status="on_leave" data-id="${staffId}" data-name="${name}" data-wksection="${workingSection}">
                    <i class="fas fa-bed me-1"></i> On Leave
                </button>
            `;
        }

        $("#statusModal #statusButtons").html(buttonHtml);
    });

    $(document).on('click', '.status-change-btn', function(e) {
        $("#statusModal").modal('hide');

        const staffId = $(this).data('id');
        const status  = $(this).data('status');
        console.log(staffId);
        console.log(status);

        $.ajax({
            url: "{{ route('doctor.staff.changeStatus', ':id') }}".replace(':id', staffId),
            type: "POST",
            data: {
                status: status
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {
                console.log(response);

                if(response.status) {
                    handleAjaxResponseSuccess(response.message)
                } else {
                    handleAjaxResponseError(response.message);
                }
            },

            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            }
        });
    });

    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();

        const userId = $(this).data('user-id');
        const staffId = $(this).data('staff-id');
        const name = $(this).data('name');

        Swal.fire({
            title: "",
            html: `Are you want to delete<span class="text-danger fw-bold"> ${name}</span>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: "#d33",
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: "{{ route('doctor.staff.destroy', ':id') }}".replace(':id', staffId),
                    type: "DELETE",
                    data: {
                        userId:userId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {
                        console.log(response);

                        if(response.status) {
                            handleAjaxResponseSuccess(response.message)
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
</script>
@endpush