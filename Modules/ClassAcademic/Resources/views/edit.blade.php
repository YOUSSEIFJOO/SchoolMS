@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">


        <li class="breadcrumb-item">

            <a href="{{ route('dashboard.home') }}">Home</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('academic.index') }}">Academic</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('classAcademic.index') }}">Classes Academic</a>

        </li>

        <li class="breadcrumb-item active">Edit</li>

    </ol>

    <form class="mb-5" action="{{ route('classAcademic.update', $class->id) }}" method="post">

        @csrf

        <input type="hidden" value="{{ $class->id }}" name="classAcademic_id">

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="name" class="font-2xl"> Name :- </label>

                    <input
                        class="form-control"
                        type="text"
                        name="name"
                        value="{{ $class->name }}"
                        id="name"
                        placeholder="Write Name Ex :- First, Second"
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

                    <label for="capacity_sections" class="font-2xl"> Capacity Of Sections :- </label>

                    <input
                        class="form-control"
                        type="number"
                        name="capacity_sections"
                        placeholder="Enter The Capacity Of This Class"
                        value="{{ $class->capacity_sections }}"
                        id="capacity_sections"
                        required
                    />

                    @error('capacity_sections')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="capacity_subjects" class="font-2xl"> Capacity Of Subjects :- </label>

                    <input
                        class="form-control"
                        type="number"
                        name="capacity_subjects"
                        placeholder="Enter The Capacity Of This Subjects"
                        value="{{ $class->capacity_subjects }}"
                        id="capacity_subjects"
                        required
                    />

                    @error('capacity_subjects')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary font-xl">
            <i class="fa fa-edit mr-1"></i> Update Class
        </button>

    </form>

@endsection
