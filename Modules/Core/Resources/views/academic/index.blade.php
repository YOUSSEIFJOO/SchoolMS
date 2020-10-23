@extends('core::layouts.layout')

@section('content')

    <header
        style = "
            background-color: #63c2e2;
            color: #ffffff;
            height: 100px;
            text-align: center;
            margin-top: 30px;
            border-radius: 10px;"
    >

        <h3 style="padding: 35px">

            <i class="fas fa-school"></i> School Management System

        </h3>

    </header>

    <div
        class="subheader"
        style="
            margin: 20px 0 50px;
            background-color: #fff;
            color: #63c2e2;
            text-align: center;
            border-radius: 10px;
            font-size: 20px;
            padding: 10px;"
    >

        <h3 class="m-0">

            <i class="nav-icon fas fa-school"></i> Academic

        </h3>

    </div>

    <div class="content">

        <div class="row">

            <div class="col-md-4">

                <div
                    class="info"
                    style="
                        background-color: #ffffff;
                        color: #63c2e2;
                        text-align: center;
                        border-radius: 10px;
                        padding: 30px 9px;
                        box-shadow: 0 4px 10px #000;"
                >
                    <h4>Classes</h4>

                    <div class="row m-0 mt-3">

                        <div class="col-md-6 p-0">

                            <a href="{{ route('classAcademic.index') }}">

                                <button
                                    class="btn"
                                    style="
                                        font-size: 16px;
                                        background-color: #2f353a;
                                        color: #FFF;
                                        font-weight: 500;
                                        box-shadow: 0 4px 10px #63c2e2;
                                        width: 90%"
                                >View Classes</button>

                            </a>

                        </div>

                        <div class="col-md-6 p-0">

                            <a href="{{ route('classAcademic.create') }}">

                                <button
                                    class="btn"
                                    style="
                                        font-size: 16px;
                                        background-color: #2f353a;
                                        color: #FFF;
                                        font-weight: 500;
                                        box-shadow: 0 4px 10px #63c2e2;
                                        width: 90%"
                                >Create Class</button>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div
                    class="info"
                    style="
                        background-color: #ffffff;
                        color: #63c2e2;
                        text-align: center;
                        border-radius: 10px;
                        padding: 30px 9px;
                        box-shadow: 0 4px 10px #000;"
                >
                    <h4>Sections</h4>

                    <div class="row m-0 mt-3">

                        <div class="col-md-6 p-0">

                            <a href="{{ route('sectionAcademic.index') }}">

                                <button
                                    class="btn"
                                    style="
                                        font-size: 16px;
                                        background-color: #2f353a;
                                        color: #FFF;
                                        font-weight: 500;
                                        box-shadow: 0 4px 10px #63c2e2;
                                        width: 90%"
                                >View Sections</button>

                            </a>

                        </div>

                        <div class="col-md-6 p-0">

                            <a href="{{ route('sectionAcademic.create') }}">

                                <button
                                    class="btn"
                                    style="
                                        font-size: 16px;
                                        background-color: #2f353a;
                                        color: #FFF;
                                        font-weight: 500;
                                        box-shadow: 0 4px 10px #63c2e2;
                                        width: 90%"
                                >Create Section</button>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div
                    class="info"
                    style="
                        background-color: #ffffff;
                        color: #63c2e2;
                        text-align: center;
                        border-radius: 10px;
                        padding: 30px 9px;
                        box-shadow: 0 4px 10px #000;"
                >
                    <h4>Subjects</h4>

                    <div class="row m-0 mt-3">

                        <div class="col-md-6 p-0">

                            <a href="{{ route('subjectAcademic.index') }}">

                                <button
                                    class="btn"
                                    style="
                                        font-size: 16px;
                                        background-color: #2f353a;
                                        color: #FFF;
                                        font-weight: 500;
                                        box-shadow: 0 4px 10px #63c2e2;
                                        width: 90%"
                                >View Subjects</button>

                            </a>

                        </div>

                        <div class="col-md-6 p-0">

                            <a href="{{ route('subjectAcademic.create') }}">

                                <button
                                    class="btn"
                                    style="
                                        font-size: 16px;
                                        background-color: #2f353a;
                                        color: #FFF;
                                        font-weight: 500;
                                        box-shadow: 0 4px 10px #63c2e2;
                                        width: 90%"
                                >Create Subject</button>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
