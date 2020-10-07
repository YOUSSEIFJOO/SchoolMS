@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">


        <li class="breadcrumb-item">

            <a href="{{ route('dashboard.home') }}">Home</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('students.index') }}">Students</a>

        </li>

        <li class="breadcrumb-item active">Edit</li>

    </ol>

    <form class="mb-5" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data" method="post">

        @csrf

        <input type="hidden" value="{{ $student->id }}" name="student_id">

        <h3 class="text-info">Student Info :- </h3>

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="name" class="font-2xl"> Name :- </label>

                        <input
                            class="form-control"
                            type="text"
                            name="name"
                            value="{{ $student->name }}"
                            id="name"
                            placeholder="Write Your Name Only For Ex :- Yousseif"
                            autocomplete="off"
                            autofocus
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
                            value="{{ $student->birthday }}"
                            id="birthday"
                        />

                        @error('date')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="gender" class="font-2xl"> Gender :- </label>

                        <select class="form-control" name="gender" id="gender">

                            <option disabled selected> -- Select Your Gender -- </option>

                            <option
                                value="Male"
                                @if($student->gender == 'Male')
                                    selected
                                @endif
                            >Male</option>

                            <option
                                value="Female"
                                @if($student->gender == 'Female')
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

                        <select class="form-control" name="religion" id="religion">

                            <option disabled selected> -- Select Your Religion -- </option>

                            <option
                                value="Muslim"
                                @if($student->religion == 'Muslim')
                                    selected
                                @endif
                            >Muslim</option>

                            <option
                                value="Christian"
                                @if($student->religion == 'Christian')
                                    selected
                                @endif
                            >Christian</option>

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
                            value="{{ $student->address }}"
                            id="address"
                            placeholder="Type Your Address"
                            autocomplete="off"
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
                            value="{{ $student->email }}"
                            id="email"
                            placeholder="Type Your Email"
                            autocomplete="off"
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
                    src="{{ asset('images\students\\' . $student->photo) }}"
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

                        <label for="phone-number" class="font-2xl"> Phone Number :- </label>

                        <input
                            type="text"
                            class="form-control"
                            name="phoneNumber"
                            value="{{ $student->phoneNumber }}"
                            id="phone-number"
                            placeholder="Type Your Phone Number"
                            autocomplete="off"
                        />

                        @error('phoneNumber')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

        <h3 class="text-info">Guardian Info :- </h3>

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="father-name" class="font-2xl"> Father Name :- </label>

                        <input
                            class="form-control"
                            type="text"
                            name="fatherName"
                            value="{{ $student->fatherName }}"
                            id="father-name"
                            placeholder="Father Name For Ex :- Yousseif Ahmed"
                            autocomplete="off"
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
                            value="{{ $student->phoneNumberFather }}"
                            id="phone-number-father"
                            placeholder="Type Your Father Phone Number"
                            autocomplete="off"
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
                            value="{{ $student->motherName }}"
                            id="mother-name"
                            placeholder="Mother Name For Ex :- Maha Mohamed"
                            autocomplete="off"
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
                            value="{{ $student->phoneNumberMother }}"
                            id="phone-number-mother"
                            placeholder="Type Your Mother Phone Number"
                            autocomplete="off"
                        />

                        @error('phoneNumberMother')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

        <h3 class="text-info">Academic Info :- </h3>

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="class" class="font-2xl"> Class :- </label>

                        <select
                            class="form-control"
                            name="class"
                            id="class"
                        >
                            <option disabled selected> -- Select Class -- </option>
                            <option
                                value="First"
                                @if($student->class == "First")
                                    selected
                                @endif
                            > First </option>
                            <option
                                value="Second"
                                @if($student->class == "Second")
                                    selected
                                @endif
                            > Second </option>
                            <option
                                value="Third"
                                @if($student->class == "Third")
                                    selected
                                @endif
                            > Third </option>
                            <option
                                value="Forth"
                                @if($student->class == "Forth")
                                    selected
                                @endif
                            > Forth </option>
                            <option
                                value="Fifth"
                                @if($student->class == "Fifth")
                                    selected
                                @endif
                            > Fifth </option>
                            <option
                                value="Sixth"
                                @if($student->class == "Sixth")
                                    selected
                                @endif
                            > Sixth </option>
                        </select>

                        @error('class')
                            <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="section" class="font-2xl"> Section :- </label>

                        <select
                            class="form-control"
                            name="section"
                            id="section"
                        >
                            <option disabled selected> -- Select Section -- </option>
                            <option
                                value="A"
                                @if($student->section == 'A')
                                    selected
                                @endif
                            > A </option>
                            <option
                                value="B"
                                @if($student->section == 'B')
                                    selected
                                @endif
                            > B </option>
                            <option
                                value="C"
                                @if($student->section == 'C')
                                    selected
                                @endif
                            > C </option>
                        </select>

                        @error('section')
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
                        >
                            <option disabled selected> -- Select Shift -- </option>
                            <option
                                value="Morning"
                                @if($student->shift == 'Morning')
                                    selected
                                @endif
                            > Morning </option>
                            <option
                                value="Evening"
                                @if($student->shift == 'Evening')
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
                        >
                            <option disabled selected> -- Select Notification SMS Number -- </option>
                            <option
                                value="Father's Phone Number"
                                @if($student->notificationSms == 'Father\'s Phone Number')
                                    selected
                                @endif
                            > Father's Phone Number </option>
                            <option
                                value="Mother's Phone Number"
                                @if($student->notificationSms == 'Mother\'s Phone Number')
                                    selected
                                @endif
                            > Mother's Phone Number </option>
                            <option
                                value="Your Phone Number"
                                @if($student->notificationSms == 'Your Phone Number')
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

        <button type="submit" class="btn btn-primary font-xl">
            <i class="fa fa-edit"></i> Update Data
        </button>

    </form>

@endsection
