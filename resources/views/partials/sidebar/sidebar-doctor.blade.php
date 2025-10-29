<aside id="sidebar">
    <div class="d-flex justify-content-between p-4">
        <div class="sidebar-logo">
            <a href="#">{{ config('app.name') }}</a>
        </div>

        <button class="toggle-btn border-0" type="button">
            <i  id="icon" class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

            
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#appointments" aria-expanded="false" aria-controls="appointments">
                <i class="fas fa-clipboard-list"></i>
                <span>Appointments</span>
            </a>
            <ul id="appointments" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Appointment List</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">New Appointment</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Appointments to Confirm</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Appointments Summary</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fas fa-stethoscope"></i>
                <span>Appointment Category</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Consultation Schedule</span>
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