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

    #patient-table tbody tr td {
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
<div class="table-responsive m-3">
    <table class="table table-striped shadow" id="patient-table">
        <thead>
            <tr>
                <th scope="col" class="text-center"> Sl. No. </th>
                <th scope="col" class="text-center"> Patient Name </th>
                <th scope="col" class="text-center"> Email </th>
                <th scope="col" class="text-center"> Phone </th>
                <th scope="col" class="text-center"> Gender </th>
                <th scope="col" class="text-center"> More Details </th>
            </tr>
        </thead>
        <tbody>
            @include('doctor.patient.data.patient-table-data')
        </tbody>
    </table>
</div>

<div id="pagination-section">
    <div class="pagination-container">
        {{ $patients->links('pagination::Bootstrap-5') }}
    </div>
</div>

@include('doctor.patient.modal.details-modal')
@endsection

@push('scripts')
<script>
    $(document).on('click', '.details-btn', function(e) {
        e.preventDefault();

        const patientId = $(this).data('id');
        console.log(patientId);

        $.ajax({
            url: "{{ route('doctor.patient.show', ':id') }}".replace(':id', patientId),
            type: "GET",

            success: function(response) {
                console.log(response);

                if(response.status) {
                    $("#patientDetailsModal").modal('show');

                    $("#patientDetailsModal #patientDetailsModalLabel").text('Details about ' + response.patient.name);

                    $("#patientDetailsModal #patient-age").text(response.patient.age);
                    $("#patientDetailsModal #patient-gender").text(capitalizeFirstLetter(response.patient.gender));

                    $("#patientDetailsModal #patient-phone").text(response.patient.phone);
                    $("#patientDetailsModal #patient-email").text(response.patient.email);

                    $("#patientDetailsModal #first-appointment-date").text(response.patient.firstAppointmentDateFormatted);
                    $("#patientDetailsModal #latest-appointment-date").text(response.patient.latestAppointmentDateFormatted);
                    $("#patientDetailsModal #total-appointments").text(response.patient.appointmentsNumber);
                } else {
                    handleAjaxResponseError(response.message);
                }
            },

            error: function(xhr, status, error) {
                handleAjaxError(xhr, status, error);
            }
        })
    })
</script>
@endpush

