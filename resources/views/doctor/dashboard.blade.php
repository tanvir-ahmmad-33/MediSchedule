@extends('layouts.dashboard')

@push('styles')
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
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.24/dist/sweetalert2.all.min.js"></script>
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                html: "<span class='text-success'>Welcome Back</span><br><span class='fw-bold'>{{ session('success') }}</span><br>You have logged in successfully.",
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                toast: true,
            });
        </script>
    @endif
@endsection

@push('scripts')
@endpush