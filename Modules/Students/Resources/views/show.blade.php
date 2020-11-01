@extends('core::layouts.layout')

@section('content')

    <div class="header-items pt-4 pb-4" style="height: 84px; line-height: 10px">

        <div class="row">

            <div class="col-md-10">

                <ol class="breadcrumb sub-bar">

                    <li class="breadcrumb-item">

                        <a href="{{ route('dashboard.home') }}">Home</a>

                    </li>

                    <li class="breadcrumb-item">

                        <a href="{{ route('students.index') }}">Students</a>

                    </li>

                    <li class="breadcrumb-item active">View</li>

                </ol>

            </div>

            <div class="col-md-2">

                <div class="button-groups">

                    <a class="text-decoration-none text-white" href="{{ route('students.edit', $student->id) }}">

                        <button class="btn btn-danger w-100 text-light">

                                <i class="fa fa-edit text-light"></i> Edit

                        </button>

                    </a>

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
                                src="{{ asset('images\students\\' . $student->photo) }}"
                                class="w-100 img-thumbnail rounded-circle"
                            />

                        </div>

                        <div class="name font-xl">

                            <p class="m-0">

                                {{ \Modules\Core\Http\Helper\AppHelper::upperWords($student->name) }}

                                {{ \Modules\Core\Http\Helper\AppHelper::upperWords($student->fatherName) }}


                            </p>

                        </div>

                        <div class="class">

                            <p class="m-0">

                                {{ \Modules\Core\Http\Helper\AppHelper::selectPropertyWithWhere($instanceClass, "name", "id", $student->class_id_students) }}

                            </p>

                        </div>

                    </div>

                    <div class="content">

                        <div class="phone pl-3 pr-3">

                            <div class="row m-0 pt-2 pb-2 border-top" style="border-color: #CCC">

                                <div class="col-md-3 p-0 font-weight-bold">

                                    <p class="m-0">Phone :- </p>

                                </div>

                                <div class="col-md-9 p-0 text-right text-info">

                                    <p class="m-0">{{ $student->phoneNumber }}</p>

                                </div>

                            </div>

                        </div>

                        <div class="email pl-3 pr-3">

                            <div class="row m-0 pt-2 pb-2 border-top" style="border-color: #CCC">

                                <div class="col-md-3 p-0 font-weight-bold">

                                    <p class="m-0">Email :- </p>

                                </div>

                                <div class="col-md-9 p-0 text-right text-info">

                                    <p class="m-0">{{ $student->email }}</p>

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

                            <h4 class="text-info pb-1" style="border-bottom: 1px solid #CCC">Personal Info :- </h4>

                            <div class="content mt-3">

                                <div class="row m-0">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Full Name</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $student->name }} {{ $student->fatherName }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Date Of Birth</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $student->birthday }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row m-0 mt-1">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Gender</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $student->gender }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Religion</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $student->religion }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row m-0 mt-1">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Address</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $student->address }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Email</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $student->email }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="parents-info mt-3">

                            <h4 class="text-info pb-1" style="border-bottom: 1px solid #CCC">Parents Info :- </h4>

                            <div class="content mt-3">

                                <div class="row m-0">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Father Name</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $student->fatherName }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-6 p-0">

                                                <p class="m-0 font-weight-bold">Father Phone Number</p>

                                            </div>

                                            <div class="col-sm-6 p-0">

                                                <p class="m-0"> : {{ $student->phoneNumberFather }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row m-0 mt-1">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Mother Name</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $student->motherName }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-6 p-0">

                                                <p class="m-0 font-weight-bold">Mother Phone Number</p>

                                            </div>

                                            <div class="col-sm-6 p-0">

                                                <p class="m-0"> : {{ $student->phoneNumberMother }}</p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="academic-info mt-3">

                            <h4 class="text-info pb-1" style="border-bottom: 1px solid #CCC">Academic Info :- </h4>

                            <div class="content mt-3">

                                <div class="row m-0">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Class</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0">

                                                     : {{ \Modules\Core\Http\Helper\AppHelper::selectPropertyWithWhere($instanceClass, "name", "id", $student->class_id_students) }}

                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-5 p-0">

                                                <p class="m-0 font-weight-bold">Section</p>

                                            </div>

                                            <div class="col-sm-7 p-0">

                                                <p class="m-0">

                                                     : {{ \Modules\Core\Http\Helper\AppHelper::selectPropertyWithWhere($instanceSection, "name", "id", $student->section_id_students) }}

                                                </p>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="row m-0 mt-1">

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-4 p-0">

                                                <p class="m-0 font-weight-bold">Shift</p>

                                            </div>

                                            <div class="col-sm-8 p-0">

                                                <p class="m-0"> : {{ $student->shift }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-6 p-0">

                                        <div class="row m-0">

                                            <div class="col-sm-5 p-0">

                                                <p class="m-0 font-weight-bold">Notification SMS</p>

                                            </div>

                                            <div class="col-sm-7 p-0">

                                                <p class="m-0"> : {{ $student->notificationSms }}</p>

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
