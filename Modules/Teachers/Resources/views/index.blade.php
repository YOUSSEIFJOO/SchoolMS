@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">

        <li class="breadcrumb-item">

            <a href="{{ route('home.index') }}">Home</a>

        </li>

        <li class="breadcrumb-item">Teachers</li>

    </ol>

    <div class="classification">

        <div class="row">

            <div class="col-md-9">

                <form action="{{ route('teachers.index') }}" method="get">

                    <div class="row m-0">

                        <div class="col-md-2">

                            <select name="class_id_teachers" class="form-control d-none d-sm-block">

                                <option disabled selected> -- Class -- </option>

                                <option value=""> No Selected </option>

                                @foreach($classes as $class)

                                    <option

                                        value="{{ $class->id }}"

                                        @if(request()->class_id_teachers == $class->id) selected @endif

                                    > {{ $class->name }} </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-2">

                            <select name="section_id_teachers" class="form-control d-none d-sm-block">

                                <option disabled selected> -- Section -- </option>

                                <option value=""> No Selected </option>

                                @foreach($sections as $section)

                                    <option

                                        value="{{ $section->id }}"

                                        @if(request()->section_id_teachers == $section->id) selected @endif

                                    > {{ $section->name }} </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-3">

                            <input
                                class="form-control"
                                name="name"
                                value="{{ request()->name }}"
                                type="text"
                                placeholder="... Teacher Name ..."
                                autocomplete="off"
                            />

                        </div>

                        <div class="col-md-3">

                            <input
                                class="form-control"
                                name="designation"
                                value="{{ request()->designation }}"
                                type="text"
                                placeholder="... Teacher designation ..."
                                autocomplete="off"
                            />

                        </div>

                        <div class="col-md-2 col-sm-12">

                            <button class="btn btn-behance d-none d-sm-block w-100">

                                <i class="fas fa-search mr-1"></i> Search

                            </button>

                        </div>

                    </div>

                </form>

            </div>

            <div class="col-md-3">

                <a href="{{ route('teachers.create') }}" class="text-decoration-none">

                    <button class="btn btn-block btn-info text-light">

                            <i class="fa fa-plus mr-2"></i> Add New Teacher

                    </button>

                </a>

            </div>

        </div>

    </div>

    @foreach (['danger', 'success'] as $msg)

        @if(Session::has($msg))

            <p
                class="alert alert-{{ $msg }} m-0 mt-2 text-center font-xl pt-2 pr-0 pb-2 pl-0"
            > ..... {{ Session::get($msg) }} ..... </p>

        @endif

    @endforeach

    <div class="table-responsive">

        <div class="card-body pr-0 pl-0">

            <table class="table table-responsive-sm table-striped">

                <thead class="text-center">

                    <tr>

                        <th>#</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Designation</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody class="text-center">

                    @if($teachers->count() > 0)

                        @foreach($teachers as $index => $teacher)

                            <tr>

                                <td> {{ $index }} </td>

                                <td> {{ \Modules\Core\Http\Helper\AppHelper::upperWords($teacher->name) }} </td>

                                <td>

                                    {{ \Modules\Core\Http\Helper\AppHelper::selectPropertyWithWhere($instanceClass, "name", "id", $teacher->class_id_teachers) }}

                                </td>

                                <td>

                                    {{ \Modules\Core\Http\Helper\AppHelper::selectPropertyWithWhere($instanceSection, "name", "id", $teacher->section_id_teachers) }}

                                </td>

                                <td> {{ $teacher->designation }} </td>

                                <td>

                                    <a href="{{ route('teachers.show', $teacher->id) }}" class="text-light">

                                        <button type="button" class="btn btn-primary" title="Show">
                                            <i class="fa fa-eye"></i>
                                        </button>

                                    </a>

                                    <a href="{{ route('teachers.edit', $teacher->id) }}">

                                        <button type="button" class="btn btn-info" title="Edit">
                                            <i class="fa fa-edit text-light"></i>
                                        </button>

                                    </a>

                                    <form
                                        action="{{ route('teachers.delete', $teacher->id) }}"
                                        method="post"
                                        style="display: inline-block"
                                    >

                                        @csrf
                                        @method("DELETE")

                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                            onclick="return confirm('Are You Sure You Want To Delete This Record ?')"
                                            title="Delete"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    @else

                        <tr>

                            <td colspan="6">

                                <p class="font-weight-bold font-2xl m-0">Sorry, There's No Data.</p>

                            </td>

                        </tr>

                    @endif

                </tbody>

            </table>

            <div class="pag-count">

                <div class="row m-0">

                    <div class="col-sm-6 p-0">

                        {{ $teachers->appends(request()->query())->links() }}

                    </div>

                    <div class="col-sm-6 p-0 text-right">

                        Showing 1 To {{ $paginationNumber }} Of {{ $teachers->count() }} Entries

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
