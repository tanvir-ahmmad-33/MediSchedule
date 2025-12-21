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

    .card:hover {
        transform: translateY(-0px);
        color: var(--bright-gray);
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
@if($pendingStaffs->isNotEmpty())
    <div class="d-flex flex-wrap mt-3 justify-content-center">
        @foreach($pendingStaffs as $staff)
            <div class="card shadow-lg m-3" style="width: 26rem;">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $staff->name }}</h5>
                    <p class="card-text">
                        <strong>Email: </strong>{{ $staff->email }} <br>
                        <strong>Phone: </strong>{{ $staff->phone }} <br>
                        <strong>Gender: </strong>{{ ucfirst($staff->gender) }} <br>
                    </p>
                    <div class="text-center">
                        <button class="btn btn-success btn-sm staff-approve-btn" data-id="{{ $staff->id }}" data-name="{{ $staff->name }}">Approve</button>
                        <button class="btn btn-danger btn-sm staff-decline-btn" data-id="{{ $staff->id }}" data-name="{{ $staff->name }}">Decline</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="d-flex justify-content-center mt-3">
    <div class="card shadow p-3" style="width: 24rem;">
        <div class="card-body text-center">
            <h5 class="card-title">Pending Staff</h5>
            <p class="card-text">
                There are no pending staff at the moment.
                You can view existing staff or add a new one.
            </p>
            <div class="d-flex justify-content-center gap-2">
                <a href="#" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-users me-1"></i> View All Staff
                </a>
                <a href="#" class="btn btn-sm btn-outline-success">
                    <i class="fas fa-user-plus me-1"></i> Add New Staff
                </a>
            </div>
        </div>
    </div>
</div>
@endif

@include('doctor.staff.modal.edit')
@endsection

@push('scripts')
<script>
    $(document).on('click', '.staff-approve-btn', function(e) {
        e.preventDefault();

        const staffId = $(this).data('id');
        const staffName = $(this).data('name');

        $.ajax({
            url: "{{ route('doctor.staff.edit', ':id') }}".replace(':id', staffId),
            type: "GET",

            success: function(response) {
                console.log(response);

                if(response.status) {
                    $("#editStaffModal").modal('show');
                    
                    $("#editStaffModal .staff_name").text(response.staff.name);
                    $("#editStaffModal .staff_phone").text(response.staff.phone);
                    $("#editStaffModal .staff_email").text(response.staff.email);
                    $("#editStaffModal .staff_gender").text(response.staff.gender);

                    $("#editStaffModal #staff-profile-approve-form #user_id").val(response.staff.id);
                } else {
                    handleAjaxResponseError(response.message);
                }
            },

            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error)
            }

        });
    });

    $(document).on('submit', '#staff-profile-approve-form', function(e) {
        e.preventDefault();

        const form = $(this);
        let isValid = true;

        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();

        function errorField(selector, message) {
            isValid = false;
            const input = form.find(selector);
            input.addClass('is-invalid').removeClass('is-valid');
            input.after(`<div class="invalid-feedback">${message}</div>`);
        }

        const userId         = form.find("#user_id").val();
        const workingSection = form.find("#working_section").val();
        const experience     = form.find("#experience").val();
        const age            = form.find("#age").val();

        console.log(workingSection);

        if(!workingSection) errorField('#working_section', "Please select a profession.");
        else form.find("#working_section").addClass('is-valid').removeClass('is-invalid');
        if(!experience || experience < 0) errorField('#experience', "Please enter a valid experience.");
        else form.find("#experience").addClass('is-valid').removeClass('is-invalid');
        if(!age || age < 18) errorField('#age', "Please enter a valid age (18 or above).");
        else form.find("#age").addClass('is-valid').removeClass('is-invalid');

        if(!isValid) {
            return;
        }

        const formData = new FormData(form[0]);

        const submitBtn = form.find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        submitBtn.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Creating New Staff Member...');

        $.ajax({
            url: "{{ route('doctor.staff.approve', ':id') }}".replace(':id', userId),
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
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

                form[0].reset();
            },

            error: function(xhr, stataus, error) {
                handleAjaxError(xhr, status, error);
            },

            complete: function() {
                submitBtn.prop('disabled', false).text('Create New Staff Member');
            }
        });
    });

    $(document).on('click', '.staff-decline-btn', function(e) {
        e.preventDefault();

        const staffId = $(this).data('id');
        const staffName = $(this).data('name');

        Swal.fire({
            'html': `Are you want to delete ${staffName}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('doctor.approval.destroy', ':id') }}".replace(':id', staffId),
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {
                        console.log(response);

                        if(response.status) {
                            handleAjaxResponseSuccess(response.message, "{{ route('doctor.staff.index') }}")
                        } else {
                            handleAjaxResponseError(response.message);
                        }
                    },

                    error: function(xhr, status, error) {
                        handleAjaxError(xhr, status, error);
                    }
                })
            }
        });
    });
</script>
@endpush