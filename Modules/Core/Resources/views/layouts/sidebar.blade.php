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

        </ul>

    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>

</div>
