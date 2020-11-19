@extends('core::layouts.layout')

@section('content')

    <div class="header-home mt-4" style="height: 120px">

        <div class="row h-100">

            <div class="col-md-3 h-100">

                <a
                    href="{{ route('students.index') }}"
                    class="card text-white bg-danger d-block h-100 text-center "
                    style="padding-top: 25px;text-decoration: none">

                    <h3> {{ \Modules\Students\Entities\Student::count() }} </h3>

                    <p class="font-3xl">Student</p>

                </a>

            </div>

            <div class="col-md-3" style="height: 120px">

                <a href="{{ route('teachers.index') }}" class="card text-white bg-success d-block h-100 text-center" style="padding-top: 25px;text-decoration: none">

                    <h3> {{ \Modules\Teachers\Entities\Teacher::count() }} </h3>

                    <p class="font-3xl">Teacher</p>

                </a>

            </div>

            <div class="col-md-3" style="height: 120px">

                <a href="{{ route('employees.index') }}" class="card text-white bg-info d-block h-100 text-center" style="padding-top: 25px;text-decoration: none">

                    <h3> {{ \Modules\Employees\Entities\Employee::count() }} </h3>

                    <p class="font-3xl">Employee</p>

                </a>

            </div>

            <div class="col-md-3" style="height: 120px">

                <a href="{{ route('classAcademic.index') }}" class="card text-white bg-warning d-block h-100 text-center" style="padding-top: 25px;text-decoration: none">

                    <h3> {{ \Modules\ClassAcademic\Entities\ClassAcademic::count() }} </h3>

                    <p class="font-3xl">Class</p>

                </a>

            </div>

        </div>

    </div>

@endsection
