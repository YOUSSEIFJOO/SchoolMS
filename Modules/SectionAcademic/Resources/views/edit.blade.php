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

            <a href="{{ route('sectionAcademic.index') }}">Sections Academic</a>

        </li>

        <li class="breadcrumb-item active">Edit</li>

    </ol>

    <form class="mb-5" action="{{ route('sectionAcademic.update', $section->id) }}" method="post">

        @csrf

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="name" class="font-2xl"> Name :- </label>

                    <input
                        class="form-control"
                        type="text"
                        name="name"
                        value="{{ $section->name }}"
                        id="name"
                        placeholder="Write Name Ex :- A, B"
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

                    <label for="capacity_students" class="font-2xl"> Capacity Of Students :- </label>

                    <input
                        class="form-control"
                        type="number"
                        name="capacity_students"
                        placeholder="Enter The Capacity Of This Class"
                        value="{{ $section->capacity_students }}"
                        id="capacity_students"
                    />

                    @error('capacity_students')
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

                                @if($section->class_id === $class->id) selected @endif

                                @if(count($checkCapacity) > 0)

                                    @foreach($checkCapacity as $checkCapacities)

                                        @if($class->id === $checkCapacities && $section->class_id !== $class->id) disabled @endif

                                    @endforeach

                                @endif

                            > {{ $class->name }} </option>

                        @endforeach

                    </select>

                    @error('class')
                    <div class="alert alert-danger mt-2 p-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary font-xl">
            <i class="fa fa-edit mr-1"></i> Update Subject
        </button>

    </form>

@endsection
