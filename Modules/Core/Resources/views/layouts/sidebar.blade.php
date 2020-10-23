<div class="sidebar">

    <nav class="sidebar-nav">

        <ul class="nav">

            {{-- Home --}}
            <li class="nav-item">

                <a class="nav-link" href="{{ route('dashboard.home') }}">

                    <i class="nav-icon icon-speedometer"></i> Home

                </a>

            </li>

            {{-- Students --}}
            <li class="nav-item">

                <a class="nav-link" href="{{ route('students.index') }}">

                    <i class="nav-icon fa fa-graduation-cap"></i>Students

                </a>

            </li>

            {{-- Teachers --}}
            <li class="nav-item">

                <a class="nav-link" href="{{ route('teachers.index') }}">

                    <i class="nav-icon fa fa-user-secret"></i>Teachers

                </a>

            </li>

            {{-- Employees --}}
            <li class="nav-item">

                <a class="nav-link" href="{{ route('employees.index') }}">

                    <i class="nav-icon fas fa-people-carry"></i>Employees

                </a>

            </li>

            {{-- All Attendance --}}
            <li class="nav-item">

                <a class="nav-link" href="{{ route('attendance.index') }}">

                    <i class="nav-icon fas fa-clipboard"></i> Attendance

                </a>

            </li>

            {{-- All Attendance --}}
            <li class="nav-item">

                <a class="nav-link" href="{{ route('academic.index') }}">

                    <i class="nav-icon fas fa-school"></i> Academic

                </a>

            </li>

        </ul>

    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>

</div>
