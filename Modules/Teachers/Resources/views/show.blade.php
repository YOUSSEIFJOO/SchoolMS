@extends('core::layouts.layout')

@section('content')

    <div class="header-items pt-4 pb-4" style="height: 84px; line-height: 10px">

        <div class="row m-0">

            <div class="col-md-9 p-0">

                <ol class="breadcrumb sub-bar pr-0 pl-0">

                    <li class="breadcrumb-item">

                        <a href="{{ route('dashboard.home') }}">Home</a>

                    </li>

                    <li class="breadcrumb-item">

                        <a href="{{ route('teachers.index') }}">Teachers</a>

                    </li>

                    <li class="breadcrumb-item active">View</li>

                </ol>

            </div>

            <div class="col-md-3 p-0">

                <div class="button-groups">

                    <div class="row m-0">

                        <div class="col-sm-6 p-0 pr-2">

                            <button class="btn btn-danger w-100">

                                <i class="fa fa-print text-light"></i> Print

                            </button>

                        </div>

                        <div class="col-sm-6 p-0">

                            <button class="btn btn-danger w-100 text-light">

                                <a class="text-decoration-none text-white" href="{{ route('teachers.edit', $teacher->id) }}">

                                    <i class="fa fa-edit text-light"></i> Edit

                                </a>

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="info">

        <div class="row m-0">

            <div class="col-md-3 p-0">

                <div class="card pt-3 pb-3" style="border-top: 3px solid #20a8d8">

                    <div class="card-info text-center pt-3 pb-3">

                        <div class="image w-50 mx-auto mb-2">

                            <img
                                src="{{ asset('images\teachers\\' . $teacher->photo) }}"
                                class="w-100 img-thumbnail rounded-circle"
                            />

                        </div>

                        <div class="name font-xl">

                            <p class="m-0">{{ $teacher->name }}</p>

                        </div>

                        <div class="class">

                            <p class="m-0">{{ $teacher->class }}</p>

                        </div>

                    </div>

                    <div class="content">

                        <div class="phone pl-3 pr-3">

                            <div class="row m-0 pt-2 pb-2 border-top" style="border-color: #CCC">

                                <div class="col-md-3 p-0 font-weight-bold">

                                    <p class="m-0">Phone :- </p>

                                </div>

                                <div class="col-md-9 p-0 text-right text-info">

                                    <p class="m-0">{{ $teacher->phoneNumber }}</p>

                                </div>

                            </div>

                        </div>

                        <div class="email pl-3 pr-3">

                            <div class="row m-0 pt-2 pb-2 border-top" style="border-color: #CCC">

                                <div class="col-md-3 p-0 font-weight-bold">

                                    <p class="m-0">Email :- </p>

                                </div>

                                <div class="col-md-9 p-0 text-right text-info">

                                    <p class="m-0">{{ $teacher->email }}</p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-1 p-0"></div>

            <div class="col-md-8 p-0">

                <nav>

                    <div class="nav nav-tabs" id="nav-tab" role="tablist">

                        <a
                            class="nav-item nav-link active"
                            id="nav-home-tab"
                            data-toggle="tab"
                            href="#nav-home"
                            role="tab"
                            aria-controls="nav-home"
                            aria-selected="true"
                        >Profile</a>

                    </div>

                </nav>

                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                        <div class="personal-info">

                            <div class="content mt-3">

                                <div class="row m-0">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Full Name</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->name }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Date Of Birth</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->birthday }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row m-0 mt-2">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Gender</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->gender }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Religion</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->religion }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row m-0 mt-2">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Address</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->address }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Email</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->email }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row m-0 mt-2">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Phone Number</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->phoneNumber }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Qualification</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->qualification }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row m-0 mt-2">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Designation </p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->designation  }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Join Date</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->joinDate }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row m-0 mt-2">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Subjects</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->subjects }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Class</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->class }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row m-0 mt-2">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Section</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $teacher->section }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection