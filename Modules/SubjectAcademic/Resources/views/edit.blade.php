@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">


        <li class="breadcrumb-item">

            <a href="{{ route('home.index') }}">Home</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('academic.index') }}">Academic</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('subjectAcademic.index') }}">Subjects Academic</a>

        </li>

        <li class="breadcrumb-item active">Edit</li>

    </ol>

    <form class="mb-5" action="{{ route('subjectAcademic.update', $subject->id) }}" method="post">

        @csrf

        <input type="hidden" value="{{ $subject->id }}" name="subjectAcademic_id">

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="name" class="font-2xl"> Name :- </label>

                    <input
                        class="form-control"
                        type="text"
                        name="name"
                        value="{{ $subject->name }}"
                        id="name"
                        placeholder="Write Name Ex :- Math, Arabic"
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

                    <label for="code" class="font-2xl"> Code Of Subject :- </label>

                    <input
                        class="form-control"
                        type="number"
                        name="code"
                        placeholder="Enter Unique Code EX :- 0005"
                        value="{{ $subject->code }}"
                        id="code"
                        required
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

                    <select id="class_id" name="class_id" class="form-control d-none d-sm-block" required>

                        <option disabled selected> -- Select Class -- </option>

                        @foreach($classes as $class)

                            <option

                                value="{{ $class->id }}"

                                @if($subject->class_id === $class->id) selected @endif

                            > {{ $class->name }} </option>

                        @endforeach

                    </select>

                    @error('class_id')
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
