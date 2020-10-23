@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">


        <li class="breadcrumb-item">

            <a href="{{ route('dashboard.home') }}">Home</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('employees.index') }}">Employees</a>

        </li>

        <li class="breadcrumb-item active">Edit</li>

    </ol>

    <form class="mb-5" action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data" method="post">

        @csrf

        <input type="hidden" value="{{ $employee->id }}" name="employee_id">

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="name" class="font-2xl"> Name :- </label>

                    <input
                        class="form-control"
                        type="text"
                        name="name"
                        value="{{ $employee->name }}"
                        id="name"
                        placeholder="Write Full Name Ex :- Yousseif Ahmed Mohammed"
                        autocomplete="off"
                        autofocus
                        required
                    />
                    @error('name')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="birthday" class="font-2xl"> Birthday :- </label>

                    <input
                        class="form-control"
                        type="date"
                        name="birthday"
                        value="{{ $employee->birthday }}"
                        id="birthday"
                        required
                    />

                    @error('birthday')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="gender" class="font-2xl"> Gender :- </label>

                    <select class="form-control" name="gender" id="gender" required>

                        <option disabled selected> -- Select Your Gender -- </option>

                        <option
                            value="Male"
                            @if($employee->gender == 'Male')
                            selected
                            @endif
                        >Male</option>

                        <option
                            value="female"
                            @if($employee->gender == 'Female')
                            selected
                            @endif
                        >Female</option>

                    </select>

                    @error('gender')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="religion" class="font-2xl"> Religion :- </label>

                    <select class="form-control" name="religion" id="religion" required>

                        <option disabled selected> -- Select Your Religion -- </option>

                        <option
                            value="Muslim"
                            @if($employee->religion == 'Muslim')
                            selected
                            @endif
                        >Muslim</option>

                        <option
                            value="Christian"
                            @if($employee->religion == 'Christian')
                            selected
                            @endif
                        >Christian</option>

                        <option
                            value="Other"
                            @if($employee->religion == 'Other')
                            selected
                            @endif
                        >Other</option>

                    </select>

                    @error('religion')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="address" class="font-2xl"> Address :- </label>

                    <input
                        class="form-control"
                        name="address"
                        value="{{ $employee->address }}"
                        id="address"
                        placeholder="Type Your Address"
                        autocomplete="off"
                        required
                    />

                    @error('address')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="email" class="font-2xl"> Email :- </label>

                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        value="{{ $employee->email }}"
                        id="email"
                        placeholder="Type Your Email"
                        autocomplete="off"
                        required
                    />

                    @error('email')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="form-group">

            <img
                id="photo-preview"
                class="rounded"
                src="{{ asset('images\employees\\' . $employee->time . '\\' . $employee->photo) }}"
                alt="This Photo For Student"
                height="400"
                width="100%"
            />

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="photo" class="font-2xl"> Photo :- </label>

                    <input
                        type="file"
                        class="form-control p-1"
                        name="photo"
                        id="photo"
                    />

                    @error('photo')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="phoneNumber" class="font-2xl"> Phone Number :- </label>

                    <input
                        type="text"
                        class="form-control"
                        name="phoneNumber"
                        value="{{ $employee->phoneNumber }}"
                        id="phoneNumber"
                        placeholder="Type Your Phone Number"
                        autocomplete="off"
                        required
                    />

                    @error('phoneNumber')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="qualification" class="font-2xl"> Qualification :- </label>

                    <input
                        type="text"
                        class="form-control"
                        name="qualification"
                        value="{{ $employee->qualification }}"
                        id="qualification"
                        placeholder="Type Your Qualification"
                        autocomplete="off"
                        required
                    />

                    @error('qualification')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="designation" class="font-2xl"> Designation :- </label>

                    <input
                        type="text"
                        class="form-control"
                        name="designation"
                        value="{{ $employee->designation }}"
                        id="designation"
                        placeholder="Type Your Designation"
                        autocomplete="off"
                        required
                    />

                    @error('qualification')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="joinDate" class="font-2xl"> Join Date :- </label>

                    <input
                        class="form-control"
                        type="date"
                        name="joinDate"
                        value="{{ $employee->joinDate }}"
                        id="joinDate"
                        required
                    />

                    @error('joinDate')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary font-xl">
            <i class="fa fa-edit mr-1"></i> Add New Employee
        </button>

    </form>

@endsection