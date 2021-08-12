<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @role('Staff')
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <span data-feather="home"></span>
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/attendances">
                    <span data-feather="briefcase"></span>
                    <i class="fas fa-briefcase"></i> Absensi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/overtime">
                    <span data-feather="briefcase"></span>
                    <i class="fas fa-briefcase"></i> Ajukan Lembur
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/payroll">
                    <span data-feather="briefcase"></span>
                    <i class="fas fa-briefcase"></i> Payroll
                </a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="/payroll">
                    <span data-feather="briefcase"></span>
                    <i class="fas fa-briefcase"></i> Payroll
                </a>
            </li>
            @endrole
        </ul>
    </div>
</nav>
