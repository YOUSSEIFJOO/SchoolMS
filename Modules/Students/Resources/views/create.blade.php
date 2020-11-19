@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">


        <li class="breadcrumb-item">

            <a href="{{ route('home.index') }}">Home</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('students.index') }}">Students</a>

        </li>

        <li class="breadcrumb-item active">Create</li>

    </ol>

    @if(session('noCapacity'))

        <div class="alert alert-danger alert-dismissible font-lg p-2 mb-1" style="margin-top: -20px;margin-bottom: 20px" role="alert">

            <strong>Oops :-</strong> {{ session('noCapacity') }}

            <button type="button" class="close p-2" data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

    @endif

    <form class="mb-5" action="{{ route('students.store') }}" enctype="multipart/form-data" method="post">

        @csrf

        <h3 class="text-info"> Student Info :- </h3>

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="name" class="font-2xl"> Name :- </label>

                        <input
                            class="form-control"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            id="name"
                            placeholder="Write Your Name Only For Ex :- Yousseif"
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
                            value="{{ old('birthday') }}"
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
                                @if(old('gender') == 'Male')
                                    selected
                                @endif
                            >Male</option>

                            <option
                                value="female"
                                @if(old('gender') == 'Female')
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
                                @if(old('religion') == 'Muslim')
                                    selected
                                @endif
                            >Muslim</option>

                            <option
                                value="Christian"
                                @if(old('religion') == 'Christian')
                                    selected
                                @endif
                            >Christian</option>

                            <option
                                value="Other"
                                @if(old('religion') == 'Other')
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
                            value="{{ old('address') }}"
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
                            value="{{ old('email') }}"
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
                    src="{{ asset('admin\images\default.png') }}"
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
                            required
                        />

                        @error('photo')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="phone-number" class="font-2xl"> Phone Number :- </label>

                        <input
                            type="text"
                            class="form-control"
                            name="phoneNumber"
                            value="{{ old('phoneNumber') }}"
                            id="phone-number"
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

        </div>

        <h3 class="text-info"> Guardian Info :- </h3>

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="father-name" class="font-2xl"> Father Name :- </label>

                        <input
                            class="form-control"
                            type="text"
                            name="fatherName"
                            value="{{ old('fatherName') }}"
                            id="father-name"
                            placeholder="Father Name For Ex :- Yousseif Ahmed"
                            autocomplete="off"
                            required
                        />

                        @error('fatherName')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="phone-number-father" class="font-2xl"> Phone Number Of Your Father :- </label>

                        <input
                            class="form-control"
                            type="text"
                            name="phoneNumberFather"
                            value="{{ old('phoneNumberFather') }}"
                            id="phone-number-father"
                            placeholder="Type Your Father Phone Number"
                            autocomplete="off"
                            required
                        />

                        @error('phoneNumberFather')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="mother-name" class="font-2xl"> Mother Name :- </label>

                        <input
                            class="form-control"
                            type="text"
                            name="motherName"
                            value="{{ old('motherName') }}"
                            id="mother-name"
                            placeholder="Mother Name For Ex :- Maha Mohamed"
                            autocomplete="off"
                            required
                        />

                        @error('motherName')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="phone-number-mother" class="font-2xl"> Phone Number Of Your Mother :- </label>

                        <input
                            class="form-control"
                            type="text"
                            name="phoneNumberMother"
                            value="{{ old('phoneNumberMother') }}"
                            id="phone-number-mother"
                            placeholder="Type Your Mother Phone Number"
                            autocomplete="off"
                            required
                        />

                        @error('phoneNumberMother')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

        <h3 class="text-info"> Academic Info :- </h3>

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="class_id_students" class="font-2xl"> Class :- </label>

                        <select id="class_id_students" name="class_id_students" class="form-control d-none d-sm-block" required>

                            <option disabled selected> -- Select Class -- </option>

                            @foreach($classes as $class)

                                <option

                                    value="{{ $class->id }}"

                                > {{ $class->name }} </option>

                            @endforeach

                        </select>

                        @error('class_id_students')
                        <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="section_id_students" class="font-2xl"> Section :- </label>

                        <select id="section_id_students" name="section_id_students" class="form-control d-none d-sm-block" required>

                            <option disabled selected> -- Select Section -- </option>

                        </select>

                        @error('section_id_students')
                        <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="shift" class="font-2xl"> Shift :- </label>

                        <select
                            class="form-control"
                            name="shift"
                            id="shift"
                            required
                        >
                            <option disabled selected> -- Select Shift -- </option>
                            <option
                                value="Morning"
                                @if(old('shift') == 'Morning')
                                    selected
                                @endif
                            > Morning </option>
                            <option
                                value="Evening"
                                @if(old('shift') == 'Evening')
                                    selected
                                @endif
                            > Evening </option>
                        </select>

                        @error('shift')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="notification-sms" class="font-2xl"> Notification SMS Number :- </label>

                        <select
                            class="form-control"
                            name="notificationSms"
                            id="notification-sms"
                            required
                        >
                            <option disabled selected> -- Select Notification SMS Number -- </option>
                            <option
                                value="Father's Phone Number"
                                @if(old('notificationSms') == 'Father\'s Phone Number')
                                    selected
                                @endif
                            > Father's Phone Number </option>
                            <option
                                value="Mother's Phone Number"
                                @if(old('notificationSms') == 'Mother\'s Phone Number')
                                    selected
                                @endif
                            > Mother's Phone Number </option>
                            <option
                                value="Your Phone Number"
                                @if(old('notificationSms') == 'Your Phone Number')
                                    selected
                                @endif
                            > Your Phone Number </option>
                        </select>

                        @error('notificationSms')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

        <h3 class="text-info"> Login Info :- </h3>

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="username" class="font-2xl"> Username :- </label>

                        <input
                            class="form-control"
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            id="username"
                            placeholder="Write Your username For Login"
                            autocomplete="off"
                            autofocus
                            required
                        />
                        @error('username')
                        <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="password" class="font-2xl"> Password :- </label>

                        <input
                            class="form-control"
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Write Your password For Login"
                            autocomplete="off"
                            autofocus
                            required
                        />
                        @error('password')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary font-xl">
            <i class="fa fa-plus mr-1"></i> Add New Student
        </button>

    </form>

@endsection
