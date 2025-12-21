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
    @include('partials.sidebar.sidebar-staff')
@endsection

@section('avatar')
    @if($staff['gender'] == 'male')
        <img src="{{ asset('assets/avatar/male-nurse-avatar.png') }}" class="avatar img-fluid" alt="">
    @else
        <img src="{{ asset('assets/avatar/female-nurse-avatar.png') }}" class="avatar img-fluid" alt="">
    @endif
@endsection

@section('body-content')
<div class="container">
    @include('partials.form.staff-update-form')
</div>
@endsection

@push('scripts')
@endpush