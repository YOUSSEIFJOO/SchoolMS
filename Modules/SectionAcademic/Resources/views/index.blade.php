@extends('core::layouts.layout')

@section('content')

    <ol class="breadcrumb sub-bar pr-0 pl-0">

        <li class="breadcrumb-item">

            <a href="{{ route('dashboard.home') }}">Home</a>

        </li>

        <li class="breadcrumb-item">

            <a href="{{ route('academic.index') }}">Academic</a>

        </li>

        <li class="breadcrumb-item">Sections Academic</li>

    </ol>

    <div class="classification">

        <div class="row m-0">

            <div class="col-md-9 p-0">

                <form action="{{ route('sectionAcademic.index') }}" method="get">

                    <div class="row m-0">

                        <div class="col-md-4 p-0 pr-2">

                            <input
                                class="form-control"
                                name="name"
                                value="{{ request()->name }}"
                                type="text"
                                placeholder="... Section Name ..."
                                autocomplete="off"
                            />

                        </div>

                        <div class="col-md-4 p-0 pr-2">

                            <select name="class_id" class="form-control d-none d-sm-block">

                                <option disabled selected> -- Select Class -- </option>

                                <option value=""> No Selected </option>

                                @foreach($classes as $class)

                                    <option

                                        value="{{ $class->id }}"

                                        @if(request()->class_id == $class->id) selected @endif

                                    > {{ $class->name }} </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-1 col-sm-12 p-0 pr-2">

                            <button class="btn btn-behance d-none d-sm-block">Search</button>

                        </div>

                    </div>

                </form>

            </div>

            <div class="col-md-3 p-0 pl-2">

                <a href="{{ route('sectionAcademic.create') }}" class="text-decoration-none">

                    <button class="btn btn-block btn-info text-light">

                            <i class="fa fa-plus mr-2"></i> Add New Section Academic

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
                        <th>Capacity Students</th>
                        <th>Class</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody class="text-center">

                    @if($sections->count() > 0)

                        @foreach($sections as $index => $section)

                            <tr>

                                <td> {{ $index }} </td>

                                <td> {{ $section->name }} </td>

                                <td> {{ $section->capacity_students }} </td>

                                <td>

                                    {{ \Modules\Core\Http\Helper\AppHelper::ClassName((new Modules\sectionAcademic\Entities\sectionAcademic()), $section->id, "class", "name") }}

                                </td>

                                <td>

                                    <a href="{{ route('sectionAcademic.edit', $section->id) }}">

                                        <button type="button" class="btn btn-info" title="Edit">
                                            <i class="fa fa-edit text-light"></i>
                                        </button>

                                    </a>

                                    <form
                                        action="{{ route('sectionAcademic.delete', $section->id) }}"
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

                        {{ $sections->appends(request()->query())->links() }}

                    </div>

                    <div class="col-sm-6 p-0 text-right">

                        Showing 1 To {{ $paginationNumber }} Of {{ $sections->count() }} Entries

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
