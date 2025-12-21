<aside id="sidebar">
    <div class="d-flex justify-content-between p-4">
        <div class="sidebar-logo">
            <a href="{{ route('doctor.dashboard') }}">{{ config('app.name') }}</a>
        </div>

        <button class="toggle-btn border-0" type="button">
            <i  id="icon" class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

            
    <ul class="sidebar-nav">
        <!-- Home -->
        <li class="sidebar-item">
            <a href="{{ route('doctor.dashboard') }}" class="sidebar-link">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>
        </li>

        <!-- Appointment -->
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#appointments" aria-expanded="false" aria-controls="appointments">
                <i class="fas fa-clipboard-list"></i>
                <span>Appointments</span>
            </a>
            <ul id="appointments" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('doctor.appointment.index') }}" class="sidebar-link">Appointments</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('doctor.appointment.create') }}" class="sidebar-link">New Patient Appointment</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('doctor.appointment.existed') }}" class="sidebar-link">Past Patient Appointment</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('doctor.appointment.pending') }}" class="sidebar-link">Pending Appointments</a>
                </li>
            </ul>
        </li>

        <!-- Appointment Type -->
        <li class="sidebar-item">
            <a href="{{ route('doctor.appointment-type.index') }}" class="sidebar-link">
                <i class="fas fa-stethoscope"></i>
                <span>Appointment Type</span>
            </a>
        </li>

        <!-- Appointment Schedule -->
        <li class="sidebar-item">
            <a href="{{ route('doctor.appointment-schedule.index') }}" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#schedules" aria-expanded="false" aria-controls="clinics">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Consultation Schedule</span>
            </a>
            <ul id="schedules" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('doctor.appointment-schedule.index') }}" class="sidebar-link">Schedules</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('doctor.appointment-schedule.create') }}" class="sidebar-link">Add New Schedule</a>
                </li>
            </ul>
        </li>

        <!-- Clinic -->
        <li class="sidebar-item">
            <a href="{{ route('doctor.clinic.index') }}" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#clinics" aria-expanded="false" aria-controls="clinics">
                <i class="fa-solid fa-hospital"></i>
                <span>Healthcare Facility</span>
            </a>
            <ul id="clinics" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('doctor.clinic.index') }}" class="sidebar-link">Healthcare Facilities</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('doctor.clinic.create') }}" class="sidebar-link">Add Healthcare Facility</a>
                </li>
            </ul>
        </li>

        <!-- Patient -->
        <li class="sidebar-item">
            <a href="{{ route('doctor.patient.index') }}" class="sidebar-link">
                <i class="fa-solid fa-user-injured"></i>
                <span>Patient Profiles</span>
            </a>
        </li>

        <!-- Staff Profiles -->
        <li class="sidebar-item">
            <a href="" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#staffs" aria-expanded="false" aria-controls="staffs">
                <i class="fa-solid fa-user-nurse"></i>
                <span>Staff Profiles</span>
            </a>
            <ul id="staffs" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('doctor.staff.index') }}" class="sidebar-link">Staffs</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('doctor.staff.create') }}" class="sidebar-link">Add New Staff</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('doctor.staff.pending') }}" class="sidebar-link">Pending Approvals</a>
                </li>
            </ul>
        </li>

        <!-- Health Camp -->
        <li class="sidebar-item">
            <a href="" class="sidebar-link">
                <i class="fa-solid fa-clinic-medical"></i>
                <span>Free Health Camp</span>
            </a>
        </li>
    </ul>

    <!-- Logout -->
    <div class="sidebar-footer" id="logout-btn">
        <a href="{{ route('logout') }}" class="sidebar-link" id="logout-link">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</aside>