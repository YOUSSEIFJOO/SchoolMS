@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">

        <li class="breadcrumb-item">

            <a href="{{ route('home.index') }}">Home</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('attendance.index') }}">Attendance</a>

        </li>

        <li class="breadcrumb-item">Students Attendance</li>

    </ol>

    <div class="classification">

        <div class="row m-0">

            <div class="col-md-9 p-0">

                <form action="{{ route('studentsAttendance.index') }}" method="get">

                    <div class="row m-0">

                        <div class="col-md-2 p-0 pr-2">

                            <select name="class_id_students" class="form-control d-none d-sm-block">

                                <option disabled selected> -- Class -- </option>

                                <option value=""> No Selected </option>

                                @foreach($classes as $class)

                                    <option

                                        value="{{ $class->id }}"

                                        @if(request()->class_id_students == $class->id) selected @endif

                                    > {{ $class->name }} </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-2 p-0 pr-2">

                            <select name="section_id" class="form-control d-none d-sm-block">

                                <option disabled selected> -- Section -- </option>

                                <option value=""> No Selected </option>

                                @foreach($sections as $section)

                                    <option

                                        value="{{ $section->id }}"

                                        @if(request()->section_id == $section->id) selected @endif

                                    > {{ $section->name }} </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-4 p-0 pr-2">

                            <input
                                class="form-control"
                                name="name"
                                value="{{ request()->name }}"
                                type="text"
                                placeholder="... Student Name ..."
                                autocomplete="off"
                            />

                        </div>

                        <div class="col-md-3 p-0 pr-2">

                            <input
                                class="form-control"
                                name="date"
                                value="{{ request()->date }}"
                                type="date"
                                autocomplete="off"
                            />

                        </div>

                        <div class="col-md-1 col-sm-12 p-0 pr-2">

                            <button class="btn btn-behance d-none d-sm-block">Search</button>

                        </div>

                    </div>

                </form>

            </div>

            <div class="col-md-3 p-0 pl-2">

                <a href="{{ route('studentsAttendance.create') }}" class="text-decoration-none">

                    <button class="btn btn-block btn-info text-light">

                        <i class="fa fa-plus mr-2"></i> Add New Students Attendance

                    </button>

                </a>

            </div>

        </div>

    </div>

    @foreach (['danger', 'success'] as $msg)

        @if(session()->has($msg))

            <p
                class="alert alert-{{ $msg }} m-0 mt-2 text-center font-xl pt-2 pr-0 pb-2 pl-0"
            > ..... {{ session()->get($msg) }} ..... </p>

        @endif

    @endforeach

    <div class="table-responsive">

        <div class="card-body pr-0 pl-0">

            <table class="table table-responsive-sm table-striped">

                <thead class="text-center">

                <tr>

                    <th>#</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Date</th>
                    <th>Status</th>

                </tr>

                </thead>

                <tbody class="text-center">

                @if($attendance->count() > 0)

                    @foreach($attendance as $index => $studentAttendance)

                        <tr>

                            <td> {{ $index }} </td>

                            <td> {{ $studentAttendance->name }} </td>

                            <td>

                                {{ \Modules\Core\Http\Helper\AppHelper::selectPropertyWithWhere($instanceClass, "name", "id", $studentAttendance->class_id_students) }}

                            </td>

                            <td>

                                {{ \Modules\Core\Http\Helper\AppHelper::selectPropertyWithWhere($instanceSection, "name", "id", $studentAttendance->section_id_students) }}

                            </td>

                            <td> {{ $studentAttendance->date }} </td>

                            <td>

                                @if($studentAttendance->status == "present")

                                    <span class="badge badge-success" style="font-size: 14px">{{ ucfirst($studentAttendance->status) }}</span>

                                @else

                                    <span class="badge badge-danger" style="font-size: 15px">{{ ucfirst($studentAttendance->status) }}</span>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                @else

                    <tr>

                        <td colspan="6">

                            <p class="font-weight-bold font-2xl m-0">Sorry, There's No Data.</p>

                        </td>

                    </tr>

                @endif

                </tbody>

            </table>

            <div class="pag-count">

                <div class="row m-0">

                    <div class="col-sm-6 p-0">

                        {{ $attendance->appends(request()->query())->links() }}

                    </div>

                    <div class="col-sm-6 p-0 text-right">

                        Showing 1 To {{ $paginationNumber }} Of {{ $attendance->count() }} Entries

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
