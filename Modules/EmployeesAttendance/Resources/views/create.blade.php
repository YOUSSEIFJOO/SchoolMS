@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">


        <li class="breadcrumb-item">

            <a href="{{ route('home.index') }}">Home</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('attendance.index') }}">Attendance</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('employeesAttendance.index') }}">Employees Attendance</a>

        </li>

        <li class="breadcrumb-item active">Create</li>

    </ol>

    <div class="classification">

        <div class="row m-0">

            <div class="col-md-9 p-0">

                <form action="{{ route('employeesAttendance.create') }}" method="get">

                    <input type="hidden" name="date" value="{{ date("y-m-d") }}" />

                    <div class="row m-0">

                        <div class="col-md-4 p-0 pr-2">

                            <select class="selectpicker" data-live-search="true" name="name">

                                <option value="" disabled selected>--- No Selected ---</option>

                                @foreach($employeesNameSearch as $employee)

                                    <option value="{{ $employee->name }}">

                                        {{ $employee->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-2 col-sm-12 p-0 pr-2">

                            <button type="submit" class="btn btn-behance d-none d-sm-block">Search</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <div class="alert alert-warning alert-dismissible font-lg p-2 mt-3 mb-2" role="alert">

        <strong>Hint :-</strong> By Default The Employee Are Present.

        <button type="button" class="close p-2" data-dismiss="alert" aria-label="Close">

            <span aria-hidden="true">&times;</span>

        </button>

    </div>

    <div class="alert alert-warning alert-dismissible font-lg p-2 mb-1" role="alert">

        <strong>Hint :-</strong> If You Want To Make The Employee Absent Remove The Mark Of Check Box.

        <button type="button" class="close p-2" data-dismiss="alert" aria-label="Close">

            <span aria-hidden="true">&times;</span>

        </button>

    </div>

    <form class="mb-5" action="{{ route('employeesAttendance.store') }}" method="post">

        @csrf

        <div class="table-responsive">

            <div class="card-body pr-0 pl-0">

                <table class="table table-responsive-sm table-striped">

                    <thead class="text-center">

                    <tr>

                        <th>#</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Status</th>

                    </tr>

                    </thead>

                    <tbody class="text-center">

                        @if(request()->name)

                            @if($checkAttendance !== NULL)

                                <tr>

                                    <td colspan="6">


                                        <div class="alert alert-danger alert-dismissible font-xl p-2 mb-1" role="alert">

                                            <strong>OOPS, </strong> You take This Attendance Before In Today.

                                        </div>


                                    </td>

                                </tr>

                            @else

                                @if($employees->count() > 0)

                                    @foreach($employees as $index => $employee)

                                        <input type="hidden" name="designation" value="{{ $employee->designation }}" />

                                        <input type="hidden" name="employee_id" value="{{ $employee->id }}" />

                                        <tr>

                                            <td> {{ $index }} </td>

                                            <td>

                                                <input type="hidden" name="name" value="{{ $employee->name }}" />

                                                {{ $employee->name }}

                                            </td>

                                            <td>

                                                <input type="hidden" name="date" value="{{ now() }}" />

                                                {{ date("y-m-d") }}

                                            </td>

                                            <td style="line-height: 0px">


                                                <input
                                                    type="text"
                                                    id="textCheckbox"
                                                    class="d-none"
                                                    name="status"
                                                    value="present"
                                                />

                                                <input
                                                    type="checkbox"
                                                    style="height: 20px;width: 20px"
                                                    id="checkboxCreate"
                                                    checked="checked"
                                                />

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

                            @endif

                        @else

                            <tr>

                                <td colspan="6">

                                    <p class="font-weight-bold font-2xl m-0">Sorry, You Don't Select Any Data.</p>

                                </td>

                            </tr>

                        @endif

                    </tbody>

                </table>

            </div>

        </div>

        <button type="submit" class="btn btn-primary font-xl">

            <i class="fa fa-plus mr-1"></i> Save

        </button>

    </form>

@endsection
