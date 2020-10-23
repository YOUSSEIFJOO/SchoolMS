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

            <a href="{{ route('subjectAcademic.index') }}">Subjects Academic</a>

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

    <form class="mb-5" action="{{ route('subjectAcademic.store') }}" method="post">

        @csrf

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
                        placeholder="Write Name Ex :- Math, Arabic"
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

                    <label for="code" class="font-2xl"> Code Of Subject :- </label>

                    <input
                        class="form-control"
                        type="number"
                        name="code"
                        placeholder="Enter Unique Code EX :- 0005"
                        value="{{ old('code') }}"
                        id="code"
                    />

                    @error('code')
                        <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="class_id" class="font-2xl"> Available Classes :- </label>

                    <select id="class_id" name="class_id" class="form-control d-none d-sm-block">

                        <option disabled selected> -- Select Class -- </option>

                        <option value=""> No Selected </option>

                        @foreach($classes as $class)

                            <option

                                value="{{ $class->id }}"

                                @if(old("class_id") == $class->id) selected @endif

                                @if(count($checkCapacity) > 0)

                                    @foreach($checkCapacity as $checkCapacities)

                                        @if($class->id === $checkCapacities) disabled @endif

                                    @endforeach

                                @endif

                            > {{ $class->name }} </option>

                        @endforeach

                    </select>

                    @error('class_id')
                        <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary font-xl mt-3">
            <i class="fa fa-plus mr-1"></i> Add New Subject
        </button>

    </form>

@endsection