{{-- SideBar --}}
<div class="sidebar">

    <nav class="sidebar-nav">

        <ul class="nav">

            <li class="nav-item">

                <a class="nav-link" href="{{ route('home.index') }}">

                    <i class="nav-icon icon-speedometer"></i> Home

                </a>

            </li>


            <li class="nav-item">

                <a class="nav-link" href="{{ route('students.index') }}">

                    <i class="fas fa-user-graduate nav-icon"></i> Students

                </a>

            </li>


            <li class="nav-item">

                <a class="nav-link" href="{{ route('teachers.index') }}">

                    <i class="fas fa-chalkboard-teacher nav-icon"></i> Teachers

                </a>

            </li>


            <li class="nav-item">

                <a class="nav-link" href="{{ route('employees.index') }}">

                    <i class="fas fa-users-cog nav-icon"></i> Employees

                </a>

            </li>


            <li class="nav-item">

                <a class="nav-link" href="{{ route('attendance.index') }}">

                    <i class="fas fa-clipboard-check nav-icon"></i> Attendance

                </a>

            </li>


            <li class="nav-item">

                <a class="nav-link" href="{{ route('academic.index') }}">

                    <i class="fas fa-school nav-icon"></i> Academic

                </a>

            </li>


            <li class="nav-item">

                <a class="nav-link" href="{{ route('settings.index') }}">

                    <i class="fas fa-cog nav-icon"></i> Settings

                </a>

            </li>

        </ul>

    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>

</div>
