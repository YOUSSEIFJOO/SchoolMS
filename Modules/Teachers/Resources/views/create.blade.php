@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">


        <li class="breadcrumb-item">

            <a href="{{ route('home.index') }}">Home</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('teachers.index') }}">Teachers</a>

        </li>

        <li class="breadcrumb-item active">Create</li>

    </ol>

    @if(session('noCapacity'))

        <div class="alert alert-danger alert-dismissible font-lg p-2 mb-1" role="alert">

            <strong>Oops :-</strong> {{ session('noCapacity') }}

            <button type="button" class="close p-2" data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

    @endif

    <form class="mb-5" action="{{ route('teachers.store') }}" enctype="multipart/form-data" method="post">

        @csrf

        <h3 class="text-info">Teacher Info :- </h3>

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

                        <select class="form-control" name="religion" id="religion" >

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

                        <label for="phoneNumber" class="font-2xl"> Phone Number :- </label>

                        <input
                            type="text"
                            class="form-control"
                            name="phoneNumber"
                            value="{{ old('phoneNumber') }}"
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

        </div>

        <h3 class="text-info">Designation Info :- </h3>

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="qualification" class="font-2xl"> Qualification :- </label>

                        <input
                            type="text"
                            class="form-control"
                            name="qualification"
                            value="{{ old('qualification') }}"
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
                            value="{{ old('designation') }}"
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
                            value="{{ old('joinDate') }}"
                            id="joinDate"
                            required
                        />

                        @error('joinDate')
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

                        <label for="class_id_teachers" class="font-2xl"> Class :- </label>

                        <select
                            class="form-control"
                            name="class_id_teachers"
                            id="class_id_teachers"
                            required
                        >
                            <option disabled selected> -- Select Class -- </option>

                            @foreach($classes as $class)

                                <option

                                    value="{{ $class->id }}"

                                > {{ $class->name }} </option>

                            @endforeach

                        </select>

                        @error('class_id_teachers')
                        <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="section_id_teachers" class="font-2xl"> Section :- </label>

                        <select
                            class="form-control"
                            name="section_id_teachers"
                            id="section_id_teachers"
                            required
                        >
                            <option disabled selected> -- Select Section -- </option>

                        </select>

                        @error('section_id_teachers')
                        <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label for="subject_id_teachers" class="font-2xl"> Subject :- </label>

                        <select
                            class="form-control"
                            name="subject_id_teachers"
                            id="subject_id_teachers"
                            required
                        >

                            <option disabled selected> -- Select Subject -- </option>

                        </select>

                        @error('subject_id_teachers')
                        <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

        <h3 class="text-info">Login Info :- </h3>

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
            <i class="fa fa-plus mr-1"></i> Add New Teacher
        </button>

    </form>

@endsection
