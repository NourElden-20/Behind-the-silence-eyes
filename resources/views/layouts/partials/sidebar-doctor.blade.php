<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
    style="background: linear-gradient(180deg, #0f1f4b 0%, #1a2f6b 100%);">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-4" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon mr-2">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.8">
                <ellipse cx="12" cy="12" rx="10" ry="6" />
                <circle cx="12" cy="12" r="3" fill="white" stroke="white" />
                <circle cx="12" cy="12" r="1.2" fill="#1a2f6b" stroke="none" />
            </svg>
        </div>
        <div class="sidebar-brand-text mx-2 text-left">
            <div style="font-size:1.1rem; font-weight:700; color:white; letter-spacing:1px;">Silent Eyes
            </div>
            <div
                style="font-size:0.35rem; font-weight:400; color:rgba(255,255,255,0.6); letter-spacing:2px; text-transform:uppercase;">
                Doctor Dashboard</div>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Patients -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Patients</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"> Doctors Management:</h6>
                <a class="collapse-item" href="{{ route('patients.index') }}">Patients List</a>
                <a class="collapse-item" href="{{ route('patients.create') }}">Create patient</a>

            </div>
        </div>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Logout -->
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link btn btn-link w-100 text-left" style="color:rgba(255,255,255,0.8);">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-3">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->