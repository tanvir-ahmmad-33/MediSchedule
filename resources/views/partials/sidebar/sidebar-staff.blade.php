<aside id="sidebar">
    <div class="d-flex justify-content-between p-4">
        <div class="sidebar-logo">
            <a href="{{ route('staff.dashboard') }}">{{ config('app.name') }}</a>
        </div>

        <button class="toggle-btn border-0" type="button">
            <i  id="icon" class="fa-solid fa-chevron-right"></i>
        </button>
    </div>

            
    <ul class="sidebar-nav">
        <!-- Home -->
        <li class="sidebar-item">
            <a href="{{ route('staff.dashboard') }}" class="sidebar-link">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>
        </li>

        <!-- Notification -->
        <li class="sidebar-item">
            <a href="{{ route('staff.profile.index') }}" class="sidebar-link">
                <i class="fas fa-id-card"></i>
                <span>Profile Details</span>
            </a>
        </li>
    </ul>

    <!-- Logout -->
    <div class="sidebar-footer" id="logout-btn">
        <a href="{{ route('logout') }}" class="sidebar-link" id="logout-link">
            <i class="fas fa-user-circle"></i>
            <span>Logout</span>
        </a>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</aside>